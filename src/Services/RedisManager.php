<?php

namespace PhapNguyenDuc\LaravelManager\Services;

use Illuminate\Support\Facades\Redis;

class RedisManager
{
    public function set($key, $value, $ttl = null)
    {
        if ($ttl) {
            return Redis::setex($key, $ttl, $value);
        }
        return Redis::set($key, $value);
    }

    public function get($key)
    {
        return Redis::get($key);
    }

    public function delete($key)
    {
        return response()->json(['success' => (bool)Redis::del($key)]);
    }

    public function flush()
    {
        try {
            Redis::flushdb();

            return response()->json([
                'success' => true,
                'message' => 'Redis cache has been flushed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to flush Redis: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAll($ajax = false)
    {
        return $this->fetchFromRedis('*', $ajax);
    }

    public function getRedisInfo()
    {
        return Redis::info();
    }

    public function search($pattern)
    {
        return $this->fetchFromRedis("*{$pattern}*", true);
    }

    public function fetchFromRedis($pattern = '*', $ajax = false)
    {
        $cursor = 0;
        $data = [];

        do {
            list($cursor, $keys) = Redis::scan($cursor, ['MATCH' => $pattern, 'COUNT' => 1000]);

            if (!empty($keys)) {
                // Get data types of keys using pipeline
                $types = Redis::pipeline(function ($pipe) use ($keys) {
                    foreach ($keys as $key) {
                        $pipe->type($key);
                    }
                });

                $types = array_combine($keys, $types);

                // Get TTL of each key using pipeline
                $ttls = Redis::pipeline(function ($pipe) use ($keys) {
                    foreach ($keys as $key) {
                        $pipe->ttl($key);
                    }
                });

                $ttls = array_combine($keys, $ttls);

                // Get values of keys using pipeline
                $values = Redis::pipeline(function ($pipe) use ($types) {
                    foreach ($types as $key => $type) {
                        switch ($type) {
                            case 'string':
                                $pipe->get($key);
                                break;
                            case 'list':
                                $pipe->lrange($key, 0, -1);
                                break;
                            case 'hash':
                                $pipe->hgetall($key);
                                break;
                            case 'set':
                                $pipe->smembers($key);
                                break;
                            case 'zset':
                                $pipe->zrange($key, 0, -1, 'WITHSCORES');
                                break;
                        }
                    }
                });

                // Combine keys, values, types, and TTLs into the result array
                $i = 0;
                foreach ($types as $key => $type) {
                    $value = $values[$i++];
                    $data[$key] = [
                        'type'  => $type,
                        'value' => is_string($value) ? $value : json_encode($value, JSON_UNESCAPED_UNICODE),
                        'ttl'   => $ttls[$key], // Adding TTL information
                    ];
                }
            }
        } while ($cursor != 0);

        return $ajax ? response()->json($data) : $data;
    }

    public function updateRedisKey($key, $newValue)
    {
        $type = Redis::type($key);
        switch ($type) {
            case 'string':
                Redis::set($key, $newValue);
                break;
            case 'list':
                Redis::del($key); // Xóa list cũ
                $items = json_decode($newValue, true);
                if (is_array($items)) {
                    Redis::rpush($key, ...$items);
                }
                break;
            case 'hash':
                Redis::del($key); // Xóa hash cũ
                $hashData = json_decode($newValue, true);
                if (is_array($hashData)) {
                    Redis::hmset($key, $hashData);
                }
                break;
            case 'set':
                Redis::del($key);
                $setItems = json_decode($newValue, true);
                if (is_array($setItems)) {
                    Redis::sadd($key, ...$setItems);
                }
                break;
            case 'zset':
                Redis::del($key);
                $zsetItems = json_decode($newValue, true);
                if (is_array($zsetItems)) {
                    foreach ($zsetItems as $member => $score) {
                        Redis::zadd($key, $score, $member);
                    }
                }
                break;
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Unsupported data type',
                    'newData' => []
                ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Redis key updated successfully',
            'data' => $this->fetchFromRedis()
        ]);
    }
}
