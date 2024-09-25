<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
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
        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <section class="order-form m-4">
                <div class="container pt-4">
                    <div class="row">
                        <div class="col-12 px-4">
                            <h1>Login Form</h1>
                            @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <hr class="mt-1" />
                        </div>

                        <div class="col-12">
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Email</label>
                                </div>
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="email" id="form3" name="email" class="form-control order-form-input" autocomplete="off">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Password</label>
                                </div>
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="password" name="password" id="form5" class="form-control order-form-input" autocomplete="off">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button  type="submit" data-mdb-button-init id="btnSubmit" data-mdb-ripple-init class="btn btn-primary d-block mx-auto btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
