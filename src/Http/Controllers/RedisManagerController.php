<?php

namespace PhapNguyenDuc\LaravelManager\Http\Controllers;

use Illuminate\Http\Request;
use PhapNguyenDuc\LaravelManager\Services\RedisManager;

class RedisManagerController extends Controller
{

    public function __construct(
        protected RedisManager $redisManager
    ) {}

    public function index()
    {
        $redisInfo = $this->redisManager->getRedisInfo();
        $data = $this->redisManager->getAll();

        return view('laravel-manager::redis-manager.index', [
            'redisData' => $data,
            'redisInfo' => $redisInfo
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        return empty($query) ? $this->redisManager->getAll(true) : $this->redisManager->search($query);
    }

    public function delete(Request $request)
    {
        $key = $request->input('key');
        return $this->redisManager->delete($key);
    }

    public function deleteAll()
    {
        return $this->redisManager->flush();
    }

    public function updateKey(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');

        return $this->redisManager->updateRedisKey($key, $value);
    }
}
