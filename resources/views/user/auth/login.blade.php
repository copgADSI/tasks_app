@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="card w-50">
            <div class="card-body">
                <div class="alert" id="alert"></div>
                <form id="login_form">
                    <div class="form-group" id="email_container">
                        <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico"
                            class="form-control mb-2" required>
                        <div class="invalid-feedback">
                            Ingresa un email válido.
                        </div>
                        <div class="valid-feedback" id="email-feedback">
                            Email válido.
                        </div>
                    </div>
                    <div class="form-group" id="password_container" hidden>
                        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña"
                            class="form-control mb-2">
                        <div class="invalid-feedback">
                            Contraseña es requerida.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-success" id="next_button" >Siguiente</button>
                    <button type="submit" class="btn btn-success" id="login_button"  hidden>Ingresar</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const login_form = document.getElementById('login_form')
        const next_button = document.getElementById('next_button')
        const login_button = document.getElementById('login_button')
        const email = document.getElementById('email')
        const password = document.getElementById('password')
        const email_feedback =  document.getElementById('email-feedback')
        const email_container = document.getElementById('email_container')
        const alert = document.getElementById('alert')
        const regexs = {
            password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/,
            email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
            is_not_empty: /^.+$/
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

        password.addEventListener('keyup', () => {
            if (regexs.is_not_empty.test(password.value)) {
                password.classList.add('is-valid')
                password.classList.remove('is-invalid')
            } else {
                password.classList.remove('is-valid')
                password.classList.add('is-invalid')
            }
            login_button.disabled = !regexs.is_not_empty.test(password.value)
        })

        login_form.addEventListener('submit', async(event) => {
            event.preventDefault();

            const { data } = await  axios.post(`validate-email/${email.value}`)
            email_container.hidden = data.found
            alert.classList.toggle('alert-danger')
            alert.textContent = data.message
            alert.hidden = data.found
            password_container.hidden = !data.found
        })
    </script>
    <script src="{{ asset('node_modules/axios/dist/axios.min.js') }}"></script>
@endsection
