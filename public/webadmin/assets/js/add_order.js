document.getElementById('account-search-button').addEventListener('click', function () {
    let query = document.getElementById('account-search').value.trim();

    // Kiểm tra nếu input trống thì không thực hiện tìm kiếm
    if (query === '') {
        alert('Vui lòng nhập từ khóa tìm kiếm.');
        return;
    }

    fetch(accountSearchRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ query: query })
    })
    .then(response => response.json())
    .then(data => {
        let resultsDiv = document.getElementById('account-search-results');
        resultsDiv.innerHTML = ''; // Clear previous results
        let table = resultsDiv.querySelector('table');

        // Nếu bảng chưa tồn tại, tạo bảng mới và thêm header
        if (!table) {
            table = document.createElement('table');
            table.classList.add('table');
            let thead = document.createElement('thead');
            let headerRow = document.createElement('tr');
            headerRow.innerHTML = `
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th></th>
            `;
            thead.appendChild(headerRow);
            table.appendChild(thead);
            let tbody = document.createElement('tbody');
            table.appendChild(tbody);
            resultsDiv.appendChild(table);
        }

        let tbody = table.querySelector('tbody');

        data.forEach(account => {
            let row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <div>
                        <strong style="color:#593bdb;">${account.fullname}</strong>
                    </div>
                </td>
                <td>${account.email}</td>
                <td>
                    <div>
                        <strong style="color:#593bdb;">${account.phone}</strong>
                    </div>
                </td>
                <td><button class="btn btn-danger remove-product" type="button">&times;</button></td>
            `;
            tbody.appendChild(row);
        });

        // Sự kiện click cho nút "Xóa"
        document.querySelectorAll('.remove-product').forEach(button => {
            button.addEventListener('click', function () {
                let row = this.closest('tr');
                row.remove();
            });
        });

        // Store search results in session
        fetch(accountStoreInSessionRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ results: data })
        })
        .then(response => response.json())
        .then(sessionResponse => {
            if (sessionResponse.success) {
                console.log('Search results stored in session.');
            }
        })
        .catch(error => console.error('Error storing results in session:', error));

        // Xóa nội dung của input tìm kiếm
        document.getElementById('account-search').value = '';
    })
    .catch(error => console.error('Error:', error));
});


///////////// products seacrh

document.getElementById('search-button').addEventListener('click', function () {
    let query = document.getElementById('product-search').value.trim();

    // Kiểm tra nếu input trống thì không thực hiện tìm kiếm
    if (query === '') {
        alert('Vui lòng nhập từ khóa tìm kiếm.');
        return;
    }

    fetch(productSearchRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ query: query })
    })
        .then(response => response.json())
        .then(data => {
            let resultsDiv = document.getElementById('search-results');
    resultsDiv.innerHTML = ''; // Clear previous results

            let table = resultsDiv.querySelector('table');

            // Nếu bảng chưa tồn tại, tạo bảng mới và thêm header
            if (!table) {
                table = document.createElement('table');
                table.classList.add('table');
                let thead = document.createElement('thead');
                let headerRow = document.createElement('tr');
                headerRow.innerHTML = `
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá (đ)</th>
        <th>Thành tiền (đ)</th>
        <th></th>
    `;
                thead.appendChild(headerRow);
                table.appendChild(thead);
                let tbody = document.createElement('tbody');
                table.appendChild(tbody);
                resultsDiv.appendChild(table);
            }

            let tbody = table.querySelector('tbody');

            data.forEach(product => {
                let row = document.createElement('tr');
                row.innerHTML = `
        <td>
            <div>
                <strong style="color:#593bdb;">${product.name}</strong>
                <p>SKU: ${product.keyword}</p>
            </div>
        </td>
        <td><input type="number" class="form-control quantity" value="1" min="1" data-price="${product.price}"></td>
        <td style="color:#593bdb;">${parseInt(product.price).toLocaleString()} đ </td>
        <td class="total-price">${parseInt(product.price).toLocaleString()} đ</td>
        <td><button class="btn btn-danger remove-product" type="button">&times;</button></td>
    `;
                tbody.appendChild(row);
            });

            // Sự kiện input cho số lượng sản phẩm
            document.querySelectorAll('.quantity').forEach(input => {
                input.addEventListener('input', function () {
                    let row = this.closest('tr');
                    let price = parseInt(this.getAttribute('data-price'));
                    let quantity = parseInt(this.value);
                    let totalPrice = price * quantity;
                    row.querySelector('.total-price').innerText = totalPrice.toLocaleString() + ' đ';
                    updateTotalPrice();
                    updateProductCount();
                });
            });

            // Sự kiện click cho nút "Xóa"
            document.querySelectorAll('.remove-product').forEach(button => {
                button.addEventListener('click', function () {
                    let row = this.closest('tr');
                    row.remove();
                    updateTotalPrice();
                    updateProductCount();
                });
            });

            // Cập nhật tổng giá tiền và số lượng sản phẩm sau khi thêm sản phẩm mới
            updateTotalPrice();
            updateProductCount();

            // Xóa nội dung của input tìm kiếm
            document.getElementById('product-search').value = '';
        })
        .catch(error => console.error('Error:', error));
});

// Hàm tính và cập nhật tổng giá tiền
function updateTotalPrice() {
    let totalPrice = 0;
    document.querySelectorAll('.total-price').forEach(cell => {
        let price = parseInt(cell.innerText.replace(/\D/g, ''));
        totalPrice += price;
    });
    document.getElementById('total-price').innerText = totalPrice.toLocaleString() + ' đ';
    updateTotalPayment();
}

// Hàm cập nhật số lượng sản phẩm
function updateProductCount() {
    let productCount = document.querySelectorAll('#search-results table tbody tr').length;
    document.getElementById('product-count').innerText = productCount;
    updateTotalPayment();
}

// Hàm tính và cập nhật tổng thanh toán
// Hàm tính và cập nhật tổng thanh toán
function updateTotalPayment() {
    let totalPriceElement = document.getElementById('total-price');
    let discountElement = document.getElementById('discount');
    let totalPaymentElement = document.getElementById('total-payment');

    if (totalPriceElement && discountElement && totalPaymentElement) {
        let totalPrice = parseInt(totalPriceElement.innerText.replace(/\D/g, '')) || 0;
        let discount = parseInt(discountElement.innerText.replace(/\D/g, '')) || 0;
        let totalPayment = totalPrice - discount;
        totalPaymentElement.innerText = totalPayment.toLocaleString() + ' đ';
    }
}
