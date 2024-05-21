
@extends('interface.layout_interface')
    @section('content')

<form action="{{ route('gd.searchorder') }}" method="post">
                    @csrf
                    <label for="order_id_momo">Nhập Order ID từ hóa đơn:</label>
                    <input type="text" id="order_id_momo" name="order_id_momo" required>
                    <button type="submit">Search</button>
                </form>

                @if(session('order_not_found'))
                    <div class="alert alert-danger" role="alert">
                        No order is found.
                    </div>
                @endif

                @endsection