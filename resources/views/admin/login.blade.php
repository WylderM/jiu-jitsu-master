<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBRTEC ADMIN - Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('admin/img/favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-dark">
    <main class="py-5" style="min-height: calc(100vh - 72px);">
        <div class="container">
            <div class="bg-custom mx-auto row col-8 rounded shadow-sm overflow-hidden">
                <div class="col-6 bg-white p-5 d-flex align-items-center justify-content-center">
                    <img src="{{asset('admin/img/kbrtec.webp')}}" alt="KBRTEC" height="200" width="200" class="object-fit-contain">
                </div>

                <div class="col-6 d-flex align-items-center p-5">
                    <form method="POST" action="{{ route('admin.login') }}" class="form w-100">
                        @csrf <!-- Adiciona um token CSRF -->

                        <h2 class="h4 text-light mb-4">Painel Administrativo</h2>

                        <div class="row row-gap-3">
                            <div class="col-12 form-group text-light">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control bg-dark border-dark text-light @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="example@kbrtec.com.br">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 form-group text-light">
                                <label for="password">Senha:</label>
                                <input type="password" class="form-control bg-dark border-dark text-light @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <a href="{{ route('admin.recuperar-senha') }}" class="link-light"><small>Esqueci minha senha</small></a>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-light mt-3">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-custom text-light text-center py-4">
        <small>© Copyright 2023 - KBR TEC - Todos os Direitos Reservados</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>