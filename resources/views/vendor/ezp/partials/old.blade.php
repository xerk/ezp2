<div class="container">
        <div class="text-center panel panel-default">
            <ul class="nav nav-pills nav-justified">
                @foreach (App\Company::all() as $item)
                <li class="nav-item text-center"><a
                        class="nav-link {{$loop->first ? 'active' : ''}} text-center border rounded-circle" role="tab"
                        data-toggle="tab" href="#tab-{{$item->id}}" data-bs-hover-animate="bounce"><img
                            src="{{ asset('storage/'. $item->image)}}" class="center"
                            style="width: 150px;">{{ $item->name }}</a></li>
                @endforeach
            </ul>
            <div class="tab-content panel-body">
                @foreach (App\Company::all() as $company)
                <div class="tab-pane fade {{$loop->first ? 'active' : ''}} show" role="tabpanel" id="tab-{{$company->id}}">
                    <h4 class="my-5">{{ $company->name}}</h4>
                    <hr>
                    <section>
                        <div class="container" style="width: auto;">
                            <div class="row">
                                @foreach (App\Product::where('company_id', $company->id)->get() as $item)
                                <div class="col-md-3">
                                    <div class="card mb-4 box-shadow rounded-0"><img
                                            class="card-img-top w-100 d-block rounded-0"
                                            src="{{ asset('storage/'.$item->image) }}">
                                        <div class="card-body">
                                            <h4 class="card-title">Cash: {{ $item->name }}</h4>
                                            <h6 class="text-muted card-subtitle mb-2">Price: {{ $item->name }}</h6>
                                            <p class="card-text">{!! $item->body !!}</p>
                                            <form action="{{ route('cart.store', $item) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{-- <a class="card-link btn" href="#"
                                                            style="background-color: #33383b;color: #8f9296;">Supplier</a> --}}
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
                @endforeach
            </div>
        </div>
    </div>
