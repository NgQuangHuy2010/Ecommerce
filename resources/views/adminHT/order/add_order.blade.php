@extends ('adminHT.layout')
@section ('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/css/dropify.min.css" rel="stylesheet">


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <diveds class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tạo đơn hàng mới</h4>

                </div>
            </diveds>

        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">

                    <div class="card-body">
                    <form action="{{ route('ht.order_add') }}" method="post" id="step-form-horizontal" class="step-form-horizontal">
    @csrf
    <div>
        <section>
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="form-group">
                        <h5><label class="text-label">Sản phẩm</label></h5>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="product-search" placeholder="Tìm kiếm sản phẩm">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="search-button">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                 
                    <div id="search-results" class="mt-4">
    <table class="table">
        <tbody id="search-results-body">
            <!-- Các dòng sản phẩm sẽ được thêm vào đây -->
        </tbody>
    </table>
</div>

                </div>
            </div>
        </section> 
    </div>
</form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.6.2/js/dropify.min.js"></script>

<script>
    document.getElementById('search-button').addEventListener('click', function() {
    let query = document.getElementById('product-search').value;

    fetch('{{ route("product.search") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ query: query })
    })
    .then(response => response.json())
    .then(data => {
        let resultsDiv = document.getElementById('search-results');
        resultsDiv.innerHTML = '';

        if (data.length > 0) {
            let table = document.createElement('table');
            table.classList.add('table');
            let thead = document.createElement('thead');
            let headerRow = document.createElement('tr');
            let tbody = document.createElement('tbody');
            headerRow.innerHTML = `
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá (đ)</th>
                <th>Thành tiền (đ)</th>
                <th></th>
            `;
            thead.appendChild(headerRow);
            table.appendChild(thead);
            data.forEach(product => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div>
                            <strong style="color:#593bdb;">${product.name}</strong>
                            <p>SKU: ${product.keyword}</p>
                        </div>
                    </td>
                    <td><input  type="number" class="form-control quantity" value="1" min="1" data-price="${product.price}"></td>
                    <td style="color:#593bdb;">${parseInt(product.price).toLocaleString()} đ </td>
                    <td class="total-price">${parseInt(product.price).toLocaleString()} đ</td>
                    <td><button class="btn btn-danger remove-product" type="button">&times;</button></td>
                `;
                tbody.appendChild(row);
            });

            table.appendChild(tbody);
            resultsDiv.appendChild(table);

            // Sự kiện input cho số lượng sản phẩm
            document.querySelectorAll('.quantity').forEach(input => {
                input.addEventListener('input', function() {
                    let row = this.closest('tr');
                    let price = parseInt(this.getAttribute('data-price'));
                    let quantity = parseInt(this.value);
                    let totalPrice = price * quantity;
                    row.querySelector('.total-price').innerText = totalPrice.toLocaleString() + ' đ';
                });
            });

            // Sự kiện click cho nút "Xóa"
            document.querySelectorAll('.remove-product').forEach(button => {
                button.addEventListener('click', function() {
                    let row = this.closest('tr');
                    row.remove();
                });
            });
        } else {
            resultsDiv.innerHTML = '<p>No products found</p>';
        }
    })
    .catch(error => console.error('Error:', error));
});

</script>




@endsection