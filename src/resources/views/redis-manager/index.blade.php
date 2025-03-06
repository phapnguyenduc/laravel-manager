<x-phapnguyenduc::layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-phapnguyenduc::navbars.sidebar activePage="redis-manager"></x-phapnguyenduc::navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-phapnguyenduc::navbars.navs.auth titlePage="Redis Manager"></x-phapnguyenduc::navbars.navs.auth>
                <!-- End Navbar -->
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-header p-3 pt-2">
                                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">dns</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Server</p>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <div class="card-body p-3 pt-0">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <span class="mb-2 text-xs">Redis Version: <span class="text-dark font-weight-bold ms-sm-2">{{ $redisInfo['Server']["redis_version"] }}</span></span>
                                                    <span class="mb-2 text-xs">OS: <span class="text-dark ms-sm-2 font-weight-bold">{{ $redisInfo['Server']["os"] }}</span></span>
                                                    <span class="text-xs">Process ID: <span class="text-dark ms-sm-2 font-weight-bold">{{ $redisInfo['Server']["process_id"] }}</span></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-header p-3 pt-2">
                                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">memory</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Memory</p>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <div class="card-body p-3 pt-0">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <span class="mb-2 text-xs">Used Memory: <span class="text-dark font-weight-bold ms-sm-2">{{ $redisInfo['Memory']["used_memory"] }}</span></span>
                                                    <span class="mb-2 text-xs">Used Memory Peak: <span class="text-dark ms-sm-2 font-weight-bold">{{ $redisInfo['Memory']["used_memory_peak_human"] }}</span></span>
                                                    <span class="text-xs">Used Memory Lua: <span class="text-dark ms-sm-2 font-weight-bold">{{ $redisInfo['Memory']["used_memory_lua"] }}</span></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-header p-3 pt-2">
                                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">sensors</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Stats</p>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <div class="card-body p-3 pt-0">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <span class="mb-2 text-xs">Connected Clients: <span class="text-dark font-weight-bold ms-sm-2">{{ $redisInfo['Clients']["connected_clients"] }}</span></span>
                                                    <span class="mb-2 text-xs">Total Connections: <span class="text-dark ms-sm-2 font-weight-bold">{{ $redisInfo['Stats']["total_connections_received"] }}</span></span>
                                                    <span class="text-xs">Total Commands: <span class="text-dark ms-sm-2 font-weight-bold">{{ $redisInfo['Stats']["total_commands_processed"] }}</span></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4 mt-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Type key here to search...</label>
                                <input id="search" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card my-4">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                        <h6 class="text-white text-capitalize ps-3">Redis Manager Table</h6>
                                    </div>
                                </div>
                                <div class=" me-3 my-3 text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New</a>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Key</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Value</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Time to live</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                            </thead>
                                            <tbody id="results">
                                            @foreach($redisData as $key => $data)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $key }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm text-secondary mb-0">{{ Str::limit($data['value'], 50) }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-sm text-secondary mb-0">
                                                            @if($data['ttl'] == -1)
                                                                <span class="badge badge-sm bg-gradient-secondary">No Expiration</span>
                                                            @elseif($data['ttl'] == -2)
                                                                <span class="badge badge-sm bg-gradient-secondary">Expired / Does Not Exist</span>
                                                            @else
                                                                <span class="badge badge-sm bg-gradient-success">{{ $data['ttl'] }} sec</span>
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <button type="button" class="edit-btn btn btn-outline-info mb-0 p-1" data-bs-toggle="modal" data-bs-target="#editValue" data-json="{{ $data['value'] }}" data-key="{{$key}}">
                                                            <i class="material-icons opacity-10">edit</i>
                                                        </button>
                                                        <button class="delete-btn btn btn-outline-danger mb-0 p-1" type="button" data-key="{{$key}}">
                                                            <i class="material-icons opacity-10">delete</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button id="delete-all" type="button" class="btn btn-primary">Flush All</button>
                                    <button id="btn-refresh" type="button" class="btn btn-info">
                                        <i class="material-icons opacity-10">refresh</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-phapnguyenduc::footers.auth></x-phapnguyenduc::footers.auth>
                </div>
        </main>
        <x-phapnguyenduc::plugins></x-phapnguyenduc::plugins>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-xl" id="editValue" tabindex="-1" role="dialog" aria-labelledby="editValueLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="redisKey">Value</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Time to live (seconds)</label>
                            <input type="text" class="form-control">
                        </div>
                        <textarea class="form-control border border-2 p-2"
                                  placeholder="Value..." id="redisValue" name="about"
                                  rows="20" cols="50"></textarea>
                        <button class="btn btn-outline-info mt-3" id="copyBtn">Copy</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="saveChanges" type="button" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @push('js')
        <script>
            $(document).ready(function () {
                let timeout = null;
                let resultsTable = $("#results");

                $('#search').on('keydown', function () {
                    clearTimeout(timeout);
                    let inputSearch = $(this);
                    timeout = setTimeout(function() {
                        let query = inputSearch.val();
                        $.ajax({
                            url: "{{ route('redis-manager.search') }}",
                            type: "GET",
                            data: { query: query },
                            success: function (response) {
                                resultsTable.empty();
                                if ($.isEmptyObject(response)) {
                                    resultsTable.append(
                                        "<tr><td colspan='3'>No results found.</td></tr>"
                                    );
                                } else {
                                    reloadData(response);
                                }
                            }
                        });
                    }, 700);
                });

                // Handle delete button click
                $(document).on('click', '.delete-btn', function() {
                    let key = $(this).data('key');
                    let row = $(this).closest('tr');
                    if (confirm("Are you sure you want to delete this key?")) {
                        $.ajax({
                            url: "{{ route('redis-manager.delete') }}",
                            type: "DELETE",
                            data: { key: key, _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                if (response.success) {
                                    row.remove();
                                } else {
                                    alert("Failed to delete key.");
                                }
                            }
                        });
                    }
                });

                $("#delete-all").on("click", function() {
                    if (confirm("Are you sure you want to delete all ?")) {
                        $.ajax({
                            url: "{{ route('redis-manager.deleteAll') }}",
                            type: "DELETE",
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                if (response.success) {
                                    $("#results").empty().append("<tr><td colspan='3'>All keys deleted.</td></tr>");
                                } else {
                                    alert("Failed to delete keys.");
                                }
                            }
                        });
                    }
                });

                $(document).on('click', '.edit-btn', function() {
                    let data = $(this).data('json');
                    let valueString = typeof data === "object"
                        ? JSON.stringify(data, null, 2)
                        : data;
                    let key = $(this).data('key');
                    $("#redisKey").text(key);
                    $("#redisValue").val(valueString);
                });

                $("#saveChanges").click(function () {
                    let key = $("#redisKey").text();
                    let value = $("#redisValue").val();
                    $.ajax({
                        url: "{{ route('redis-manager.update') }}",
                        type: "POST",
                        data: {
                            key: key,
                            value: value,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if(response.success) {
                                resultsTable.empty();
                                reloadData(response.data)
                                alert(response.message);
                                $("#editValue").modal("hide");
                            } else {
                                alert("Failed to update.");
                            }
                        },
                        error: function (xhr) {
                            alert("Error updating Redis key");
                        }
                    });
                });

                document.getElementById("copyBtn").addEventListener("click", function() {
                    var copyText = document.getElementById("redisValue");
                    copyText.select();
                    navigator.clipboard.writeText(copyText.value).then(() => {
                        this.textContent = "Copied!";
                        setTimeout(() => this.textContent = "Copy", 1500);
                    });
                });

                $("#btn-refresh").on("click", function() {
                    $.ajax({
                        url: "{{ route('redis-manager.search') }}",
                        type: "GET",
                        data: { query: '' },
                        success: function (response) {
                            resultsTable.empty();
                            if ($.isEmptyObject(response)) {
                                resultsTable.append(
                                    "<tr><td colspan='3'>No results found.</td></tr>"
                                );
                            } else {
                                reloadData(response);
                            }
                        }
                    });
                });

                function reloadData(dataMaster) {
                    $.each(dataMaster, function (key, data) {
                        let ttlText = "";

                        if (data.ttl === -1) {
                            ttlText = `<span class="badge badge-sm bg-gradient-secondary">No Expiration</span>`;
                        } else if (data.ttl === -2) {
                            ttlText = `<span class="badge badge-sm bg-gradient-danger">Expired / Does Not Exist</span>`;
                        } else {
                            ttlText = `<span class="badge badge-sm bg-gradient-success">${data.ttl} sec</span>`; // Fixed TTL display
                        }

                        resultsTable.append(`
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">${key}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0">${data.value.length > 50 ? data.value.substring(0, 50) + "..." : data.value}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-sm text-secondary mb-0">
                                        ${ttlText}
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <button type="button" class="edit-btn btn btn-outline-info mb-0 p-1" data-bs-toggle="modal" data-bs-target="#editValue" data-json='${data.value}' data-key='${key}' >
                                        <i class="material-icons opacity-10">edit</i>
                                    </button>
                                    <button class="delete-btn btn btn-outline-danger mb-0 p-1" type="button" data-key="${key}">
                                        <i class="material-icons opacity-10">delete</i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                }
            });
        </script>
    @endpush
</x-phapnguyenduc::layout>
