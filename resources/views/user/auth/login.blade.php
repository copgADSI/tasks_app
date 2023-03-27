@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="card w-50">
            <div class="card-body">
                <div class="alert" id="alert"></div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico"
                        class="form-control mb-2" required>
                    <div class="invalid-feedback">
                        Ingresa un email válido.
                    </div>
                    <div class="valid-feedback">
                        Email válido.
                    </div>
                </div>
                <button class="btn btn-outline-success" id="next_button" disabled>Siguiente</button>
            </div>
        </div>
    </div>
    <script>
        const next_button = document.getElementById('next_button')
        const email = document.getElementById('email')
        const password = document.getElementById('password')
        const alert = document.getElementById('alert')
        const regexs = {
            password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/,
            email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
        }

        email.addEventListener('keyup', function(event) {
            if (!regexs.email.test(email.value)) {
                email.classList.remove('is-valid')
                email.classList.add('is-invalid')

            } else {
                email.classList.remove('is-invalid')
                email.classList.add('is-valid')
            }
            next_button.disabled = !regexs.email.test(email.value)
        });

        next_button.addEventListener('click', async() => {
            const { data } = await  axios.post(`validate-email/${email.value}`)
            alert.classList.toggle(data.class_list)
            alert.textContent = data.message
        })
    </script>
    <script src="{{ asset('node_modules/axios/dist/axios.min.js') }}"></script>
@endsection
