<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Order</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .order-form .container {
                color: #4c4c4c;
                padding: 20px;
                box-shadow: 0 0 10px 0 rgba(0, 0, 0, .1);
                max-width: 650px;
            }

            .order-form-label {
                margin: 8px 0 0 0;
                font-size: 14px;
                font-weight: bold;
            }

            .order-form-input,
            .form-label,
            .form-check-label {
                    font-family: 'Open Sans', sans-serif;
                    font-size: 14px;
            }

            .btn-submit:hover {
                background-color: #0D47A1 !important;
            }
        </style>
    </head>
    <body>
        <form method="POST">
        <section class="order-form m-4">
            <div class="container pt-4">
                <div class="row">
                    <div class="col-12 px-4">
                        <h1>Order Form</h1>
                        <span>please fill all informations</span>
                        <ul id="save_msgList"></ul>
                        <div id="success_message"></div>
                        <hr class="mt-1" />
                    </div>

                    <div class="col-12">
                        <div class="row mx-4">
                            <div class="col-12">
                                <label class="order-form-label">Name</label>
                            </div>
                            <div class="col-sm-6">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form1" class="form-control order-form-input" required>
                                    <label class="form-label" for="form1">First</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2 mt-sm-0">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form2" class="form-control order-form-input" required>
                                    <label class="form-label" for="form2">Last</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mx-4">
                            <div class="col-12">
                                <label class="order-form-label">Shop Product you want to order</label>
                            </div>
                            <div class="col-12">
                                <div data-mdb-input-init class="form-outline">
                                    {{--  <input type="text" id="form3" class="form-control order-form-input" />  --}}
                                    <select name="shop_product_id" class="form-control order-form-input shop_product_id" required>
                                        <option value="">Select Shop Product</option>
                                        @foreach ($shopProducts as $shopProduct)
                                            <option value="{{ $shopProduct->id }}">{{ $shopProduct->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mx-4">
                            <div class="col-12">
                                <label class="order-form-label">Adress</label>
                            </div>
                            <div class="col-12">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form5" class="form-control order-form-input" required>
                                    <label class="form-label" for="form5">Street Address</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2 pe-sm-2">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form7" class="form-control order-form-input" required>
                                    <label class="form-label" for="form7">City</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2 ps-sm-0">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form8" class="form-control order-form-input" required>
                                    <label class="form-label" for="form8">Region</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2 pe-sm-2">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form9" class="form-control order-form-input" required>
                                    <label class="form-label" for="form9">Postal / Zip Code</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2 ps-sm-0">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form10" class="form-control order-form-input" required>
                                    <label class="form-label" for="form10">Country</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button  type="submit" data-mdb-button-init id="btnSubmit" data-mdb-ripple-init class="btn btn-primary d-block mx-auto btn-submit add_order">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
<script>
    $(document).ready(function () {
        $(document).on('click', '.add_order', function (e) {
            e.preventDefault();

            $(this).text('Sending..');

            var data = {
                'shop_product_id': $('.shop_product_id').val(),
            }

            // Validate the input data
            if (!data.shop_product_id) {
                $('#save_msgList').html("");
                $('#save_msgList').addClass('alert alert-danger');
                $('#save_msgList').append('<li>Please select a shop product.</li>');
                $(this).text('Submit');
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer {{ auth()->user()->createToken('admintoken')->plainTextToken }}'
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('add.order') }}",
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#save_msgList').append('<li>' + err_value + '</li>');
                        });
                        $('.add_order').text('Submit');
                    } else {
                        $('#save_msgList').html("");
                        $('#save_msgList').hide();
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('.add_order').text('Submit');

                        $('form').find('input, select').val('');
                    }
                }
            });

        });

    });
</script>