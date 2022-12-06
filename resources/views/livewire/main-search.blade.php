<div>

    <div class="navbar-search navbar-search-light form-inline mr-sm-3">
        <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>

                <div class="relative">
                    <input class="form-control" placeholder="חיפוש ..." type="text"
                           id="search"
                           autocomplete="off"
                           wire:model="query"
                           wire:keydown.tab="resetAll"
                           wire:keydown.escape="resetAll"/>


                    @if(!empty($query) && $searchStatus && strlen($query) >= 3  )
                        <div
                            class="rounded-lg bg-white position-absolute w-100 left-0 mt-3 p-3 shadow list-group"
                            style="z-index: 999999; max-height: 300px; overflow: auto;">
                            <div wire:loading class="text-center p-3">
                                <p><i class="fas fa-spinner fa-spin"></i> מחפש... </p>
                            </div>
                            @if(count($data['workers']) > 0)
                                <h4 class="mb-0 text-black-50">עבדים</h4>
                                @foreach($data['workers'] as $i => $item)
                                    <a href="{{route('worker.show',$item['id'])}}"
                                       class="list-item px-3 py-1 border-bottom h5">{{ $item['name'] }}</a>
                                @endforeach
                            @endif

                            @if(count($data['clients']) > 0)
                                <h4 class="mb-0 text-black-50 mt-3">לקוחות</h4>
                                @foreach($data['clients'] as $i => $item)
                                    <a href="{{route('client.show',$item['id'])}}"
                                       class="list-item px-3 py-1 border-bottom h5">{{ $item['name'] }}</a>

                                @endforeach
                            @endif

                            @if(count($data['projects']) > 0)
                                <h4 class="mb-0 text-black-50 mt-3">פרויקטים</h4>
                                @foreach($data['projects'] as $i => $item)
                                    <a href="{{route('project.show',$item['id'])}}"
                                       class="list-item px-3 py-1 border-bottom h5">{{ $item['name'] }}</a>
                                @endforeach
                            @endif
                            @if(count($data['workers']) == 0 && count($data['clients']) == 0 && count($data['workers']) == 0)
                                <div class="list-item text-center p-2 mb-0 h5">לא נמצאה תוצאה ל "{{$query}}" !</div>
                            @endif


                        </div>
                    @endif
                </div>

            </div>
        </div>
        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                aria-label="Close" wire:click="resetAll">
            <span aria-hidden="true">×</span>
        </button>
    </div>


</div>
