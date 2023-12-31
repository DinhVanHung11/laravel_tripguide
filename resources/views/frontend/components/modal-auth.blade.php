<div id="modal-authorization" class="modal modal-authorization">
    <div class="modal-auth-content modal-auth-signin active">
        <h4>Welcome Back!</h4>
        <form action="{{route('user.login')}}" method="POST">
            <div class="form-group group-input">
                <label for="">Email address</label>
                <div class="input-wrap">
                    <input type="text" placeholder="Enter your email" name="email" >
                </div>
            </div>
            <div class="form-group group-input">
                <label for="">Password</label>
                <div class="input-wrap">
                    <input type="password" placeholder="Enter your password" name="password">
                    <span class="toggle-show-password">
                        <img class="eye-open active" src="{{asset('images/icon-eye.svg')}}" alt="">
                        <img class="eye-close" src="{{asset('images/icon-eye-close.svg')}}" alt="">
                    </span>
                </div>
            </div>
            <a href="#" class="forgot-password">Forgot your password?</a>
            <button class="button-primary action action-signin">Sign in</button>
            <p class="auth-other">
                Don’t have an account? <a href="javascript:void(0)" class="toggle-auth-content">Sign up</a>
            </p>
            @csrf
        </form>
    </div>
    <div class="modal-auth-content modal-auth-signup">
        <h4>Let’s go</h4>
        <form action="{{route('user.store')}}" method="POST">
            <div class="flex form-row">
                <div class="form-group group-input form-first-name first_name">
                    <label for="">First name</label>
                    <div class="input-wrap">
                        <input type="text" placeholder="First name" name="first_name" >
                    </div>
                </div>
                <div class="form-group group-input form-last-name last_name">
                    <label for="">Last name</label>
                    <div class="input-wrap">
                        <input type="text" placeholder="Last name" name="last_name" >
                    </div>
                </div>
            </div>
            <div class="form-group group-input form-email email">
                <label for="">Email address</label>
                <div class="input-wrap">
                    <input type="text" placeholder="Enter your email" name="email" >
                </div>
            </div>
            <div class="form-group group-input form-password">
                <label for="">Password</label>
                <div class="input-wrap">
                    <input type="password" placeholder="Enter your password" name="password">
                    <span class="toggle-show-password">
                        <img class="eye-open active" src="{{asset('images/icon-eye.svg')}}" alt="">
                        <img class="eye-close" src="{{asset('images/icon-eye-close.svg')}}" alt="">
                    </span>
                </div>
            </div>
            <div class="group-input auth-terms">
                <div class="checkbox-wrap">
                    <input type="checkbox" name="accept_terms" class="!border cursor-pointer !border-[#ccc]" id="auth-term">
                    <label for="auth-term" class="cursor-pointer">
                        I’ve read and accepted <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>
            </div>
            <button class="button-primary action action-signup">Sign up</button>
            <p class="auth-other">
                Already have an account? <a href="javascript:void(0)" class="toggle-auth-content">Sign in</a>
            </p>
            @csrf
        </form>
    </div>
</div>
