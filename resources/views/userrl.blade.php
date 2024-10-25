<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>RegistrationForm_v4 by Colorlib</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="/css/login.css">
	<meta name="robots" content="noindex, follow">
<script nonce="ccd7fc78-c97c-477c-b796-26e32983683f">try{(function(w,d){!function(j,k,l,m){if(j.zaraz)console.error("zaraz is loaded twice");else{j[l]=j[l]||{};j[l].executed=[];j.zaraz={deferred:[],listeners:[]};j.zaraz._v="5808";j.zaraz._n="ccd7fc78-c97c-477c-b796-26e32983683f";j.zaraz.q=[];j.zaraz._f=function(n){return async function(){var o=Array.prototype.slice.call(arguments);j.zaraz.q.push({m:n,a:o})}};for(const p of["track","set","debug"])j.zaraz[p]=j.zaraz._f(p);j.zaraz.init=()=>{var q=k.getElementsByTagName(m)[0],r=k.createElement(m),s=k.getElementsByTagName("title")[0];s&&(j[l].t=k.getElementsByTagName("title")[0].text);j[l].x=Math.random();j[l].w=j.screen.width;j[l].h=j.screen.height;j[l].j=j.innerHeight;j[l].e=j.innerWidth;j[l].l=j.location.href;j[l].r=k.referrer;j[l].k=j.screen.colorDepth;j[l].n=k.characterSet;j[l].o=(new Date).getTimezoneOffset();if(j.dataLayer)for(const t of Object.entries(Object.entries(dataLayer).reduce(((u,v)=>({...u[1],...v[1]})),{})))zaraz.set(t[0],t[1],{scope:"page"});j[l].q=[];for(;j.zaraz.q.length;){const w=j.zaraz.q.shift();j[l].q.push(w)}r.defer=!0;for(const x of[localStorage,sessionStorage])Object.keys(x||{}).filter((z=>z.startsWith("_zaraz_"))).forEach((y=>{try{j[l]["z_"+y.slice(7)]=JSON.parse(x.getItem(y))}catch{j[l]["z_"+y.slice(7)]=x.getItem(y)}}));r.referrerPolicy="origin";r.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(j[l])));q.parentNode.insertBefore(r,q)};["complete","interactive"].includes(k.readyState)?zaraz.init():j.addEventListener("DOMContentLoaded",zaraz.init)}}(w,d,"zarazData","script");window.zaraz._p=async mP=>new Promise((mQ=>{if(mP){mP.e&&mP.e.forEach((mR=>{try{const mS=d.querySelector("script[nonce]"),mT=mS?.nonce||mS?.getAttribute("nonce"),mU=d.createElement("script");mT&&(mU.nonce=mT);mU.innerHTML=mR;mU.onload=()=>{d.head.removeChild(mU)};d.head.appendChild(mU)}catch(mV){console.error(`Error executing script: ${mR}\n`,mV)}}));Promise.allSettled((mP.f||[]).map((mW=>fetch(mW[0],mW[1]))))}mQ()}));zaraz._p({"e":["(function(w,d){})(window,document)"]});})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script></head>

	<body>
        <div class="form-container">
    <div class="login-form visible" id="loginForm">
        <div class="wrapper">
            <div class="inner">
                <div class="carousel-item image-holder">
                 <img src="/img/login.jpg" alt="" style="width: 100%; height: auto;">
                 <div class="carousel-caption">
                 <a href="/">
                <img src="img/lipstick.svg">
                 <span>BEAUTINOW</span></a>
               </div>
    </div>
                
                <form action="/login" method="POST">
                    @csrf
                    <h3>Sign In To BeautiNow!</h3>
                    <div class="form-holder">
						<input type="text" class="form-control @error('email') is-invalid
                        @enderror" id="floatingInput"  placeholder="email" name="email" value="{{ old('email') }}" required>
						@error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
					</div>

					<div class="form-holder">
						<input type="password" class="form-control @error('password') is-invalid
                        @enderror" id="floatingPassword"  name="password" placeholder="Password" style="font-size: 15px;" required>
						@error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
					</div>

					

					
                    <div class="form-login">
                        <button type="submit">Sign in</button>
                        <p>Doesn't Have account? <a href="javascript:void(0);" onclick="toggleForms()">Sign up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="register-form hidden" id="registerForm">
        <div class="wrapper">
            <div class="inner">
				<form action="/register" method="POST" onsubmit="return validateRegisterForm()">
    @csrf
    <h3>Create Account</h3>

    <div class="form-holder">
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
               id="nameInput" placeholder="Name" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-holder">
        <input type="text" class="form-control @error('email') is-invalid @enderror" 
               id="emailInput" placeholder="Email" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-holder">
        <input type="password" class="form-control @error('password') is-invalid @enderror" 
               id="passwordInput" name="password" placeholder="Password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-holder">
        <input type="password" class="form-control" 
               id="passwordConfirmationInput" placeholder="Confirm Password" name="password_confirmation" required>
    </div>

    <div class="checkbox">
						<label>
							<input type="checkbox" id="agreeCheckbox" name="agree" class="@error('agree') is-invalid @enderror">
							 I agree all statement in <a href="#">Terms & Conditions</a>
							<span class="checkmark"></span>
							@error('agree')
    							<div class="invalid-feedback">
      							 	 {{ $message }}
   								 </div>
   							 @enderror
						</label>
					</div>

    <div class="form-login">
        <button type="submit">Sign Up</button>
        <p>Already have an account? <a href="javascript:void(0);" onclick="toggleForms()">Login</a></p>
    </div>

    <div class="error-messages" style="color: red;"></div>
</form>


<div class="carousel-item image-holder">
    <img src="/img/login.jpg" alt="" style="width: 100%; height: auto;">
    <div class="carousel-caption1">
        <a href="/">
                <img src="img/lipstick.svg">
            <span>BEAUTINOW</span></a>
    </div>
</div>
            </div>
        </div>
    </div>
</div>



    </main>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            if (loginForm.classList.contains('visible')) {
                loginForm.classList.remove('visible');
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                registerForm.classList.add('visible');
            } else {
                loginForm.classList.remove('hidden');
                loginForm.classList.add('visible');
                registerForm.classList.remove('visible');
                registerForm.classList.add('hidden');
            }
        }

		function validateRegisterForm() {
    const name = document.getElementById('nameInput').value.trim();
    const email = document.getElementById('emailInput').value.trim();
    const password = document.getElementById('passwordInput').value;
    const confirmPassword = document.getElementById('passwordConfirmationInput').value;
    const agreeCheckbox = document.getElementById('agreeCheckbox').checked;
    const errorMessageContainer = document.querySelector('.error-messages');

    // Reset error messages
    errorMessageContainer.innerHTML = '';
    
    let isValid = true;

    // Validasi nama
    if (!name) {
        errorMessageContainer.innerHTML += 'Name is required.<br>';
        isValid = false;
    }

    // Validasi email
    if (!email) {
        errorMessageContainer.innerHTML += 'Email is required.<br>';
        isValid = false;
    } else if (!validateEmail(email)) {
        errorMessageContainer.innerHTML += 'Please enter a valid email address.<br>';
        isValid = false;
    }

    // Validasi password
    if (!password) {
        errorMessageContainer.innerHTML += 'Password is required.<br>';
        isValid = false;
    } else if (password.length < 6) {
        errorMessageContainer.innerHTML += 'Password must be at least 6 characters.<br>';
        isValid = false;
    }

    // Validasi konfirmasi password
    if (confirmPassword !== password) {
        errorMessageContainer.innerHTML += 'Password confirmation does not match.<br>';
        isValid = false;
    }

    // Validasi checkbox
    if (!agreeCheckbox) {
        errorMessageContainer.innerHTML += 'You must agree to the terms and conditions.<br>';
        isValid = false;
    }

    // Kembalikan false jika ada kesalahan
    return isValid;
}

// Fungsi untuk memvalidasi format email
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

		
    </script>
	




		<script src="/js/jquery-3.3.1.min.js"></script>
		<script src="/js/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8cf41f494b21a1af","serverTiming":{"name":{"cfExtPri":true,"cfL4":true}},"version":"2024.8.0","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>