@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection
@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Name &amp; Seller</td>
                                    <td>Price</td>
                                    <td>Menu</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td style="width: 25%;">
                                            @if ($cart->product->galleries->count() > 0)
                                                <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                                    class="cart-image w-100" alt="">
                                            @endif
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">{{ $cart->user->name }}</div>
                                        </td>
                                        <td style="width: 35%;">
                                            <div class="product-title">${{ number_format($cart->product->price) }}</div>
                                            <div class="product-subtitle">USD</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-remove-cart">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $totalPrice += $cart->product->price;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            Shipping Details
                        </div>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_one">Address 1</label>
                                <input type="text" name="address_one" id="address_one" class="form-control"
                                    value="Setra Duta Cemara">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_two">Address 2</label>
                                <input type="text" name="address_two" id="address_two" class="form-control"
                                    value="Blok B2 No. 34">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Province</label>
                                <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id"
                                    v-if="provinces">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}
                                    </option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regencies_id">City</label>
                                <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id"
                                    v-if="regencies">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code">Postal Code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="40512" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" class="form-control" value="Indonesia">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Mobile</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control"
                                    value="+628 2020 11111">
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                Payment Information
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-4 col-md-2">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Country Tax</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Product Insurance</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title">$0</div>
                            <div class="product-subtitle">Ship to Jakarta</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title text-success">${{ number_format($totalPrice ?? 0) }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                                Checkout Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                AOS.init();
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null,
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provinces') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                },
            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                }
            }
        })
    </script>
@endpush
