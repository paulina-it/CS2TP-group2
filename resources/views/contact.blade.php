<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/No text white logo.png" type="image/png">
    <title>flippinpages</title>

    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])

</head>

<body>
    @include('layouts.navigation')
    <div class="contact-form">
        <h1>We'd Love to Hear From You</h1>
        <p class="mb-4">Whether you want to request a specific book, find out more about our services, or get support -
            we are ready to answer any and all questions. You can reach us using the form below or any of these links.
        </p>
        {{-- <h3 class="mt-5">You can reach us using the form below or any of these links:</h3> --}}
        <div class="contacts mt-5 mb-5">
            <a href="mailto:" class="mail">
                <svg class="contact-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path id="mail-svg"
                            d="M3.29289 5.29289C3.47386 5.11193 3.72386 5 4 5H20C20.2761 5 20.5261 5.11193 20.7071 5.29289M3.29289 5.29289C3.11193 5.47386 3 5.72386 3 6V18C3 18.5523 3.44772 19 4 19H20C20.5523 19 21 18.5523 21 18V6C21 5.72386 20.8881 5.47386 20.7071 5.29289M3.29289 5.29289L10.5858 12.5857C11.3668 13.3668 12.6332 13.3668 13.4142 12.5857L20.7071 5.29289"
                            stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </a>
            <a href="https://www.instagram.com/" class="inst">
                <svg class="contact-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path id="inst-svg" fill-rule="evenodd" clip-rule="evenodd"
                            d="M2 6C2 3.79086 3.79086 2 6 2H18C20.2091 2 22 3.79086 22 6V18C22 20.2091 20.2091 22 18 22H6C3.79086 22 2 20.2091 2 18V6ZM6 4C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V6C20 4.89543 19.1046 4 18 4H6ZM12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9ZM7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12ZM17.5 8C18.3284 8 19 7.32843 19 6.5C19 5.67157 18.3284 5 17.5 5C16.6716 5 16 5.67157 16 6.5C16 7.32843 16.6716 8 17.5 8Z"
                            fill="#000000"></path>
                    </g>
                </svg>
            </a>
            <a href="https://www.facebook.com/" class="fb">
                <svg class="contact-icon" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path id="fb-svg" stroke="#000000" stroke-linecap="round" stroke-width="12"
                            d="M96 170c40.869 0 74-33.131 74-74 0-40.87-33.131-74-74-74-40.87 0-74 33.13-74 74 0 40.869 33.13 74 74 74Zm0 0v-62m30-48h-10c-11.046 0-20 8.954-20 20v28m0 0H74m22 0h22">
                        </path>
                    </g>
                </svg>
            </a>
            <a href="https://www.whatsapp.com/" class="wa">
                <svg class="contact-icon" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                    <g id="SVGRepo_iconCarrier">
                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="wa-svg" id="Color-" transform="translate(-700.000000, -360.000000)"
                                fill="#000000">
                                <path
                                    d="M723.993033,360 C710.762252,360 700,370.765287 700,383.999801 C700,389.248451 701.692661,394.116025 704.570026,398.066947 L701.579605,406.983798 L710.804449,404.035539 C714.598605,406.546975 719.126434,408 724.006967,408 C737.237748,408 748,397.234315 748,384.000199 C748,370.765685 737.237748,360.000398 724.006967,360.000398 L723.993033,360.000398 L723.993033,360 Z M717.29285,372.190836 C716.827488,371.07628 716.474784,371.034071 715.769774,371.005401 C715.529728,370.991464 715.262214,370.977527 714.96564,370.977527 C714.04845,370.977527 713.089462,371.245514 712.511043,371.838033 C711.806033,372.557577 710.056843,374.23638 710.056843,377.679202 C710.056843,381.122023 712.567571,384.451756 712.905944,384.917648 C713.258648,385.382743 717.800808,392.55031 724.853297,395.471492 C730.368379,397.757149 732.00491,397.545307 733.260074,397.27732 C735.093658,396.882308 737.393002,395.527239 737.971421,393.891043 C738.54984,392.25405 738.54984,390.857171 738.380255,390.560912 C738.211068,390.264652 737.745308,390.095816 737.040298,389.742615 C736.335288,389.389811 732.90737,387.696673 732.25849,387.470894 C731.623543,387.231179 731.017259,387.315995 730.537963,387.99333 C729.860819,388.938653 729.198006,389.89831 728.661785,390.476494 C728.238619,390.928051 727.547144,390.984595 726.969123,390.744481 C726.193254,390.420348 724.021298,389.657798 721.340985,387.273388 C719.267356,385.42535 717.856938,383.125756 717.448104,382.434484 C717.038871,381.729275 717.405907,381.319529 717.729948,380.938852 C718.082653,380.501232 718.421026,380.191036 718.77373,379.781688 C719.126434,379.372738 719.323884,379.160897 719.549599,378.681068 C719.789645,378.215575 719.62006,377.735746 719.450874,377.382942 C719.281687,377.030139 717.871269,373.587317 717.29285,372.190836 Z"
                                    id="Whatsapp"> </path>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
        <form action="{{ route('contact.submit') }}" method="POST" class="rounded">
            @if (session('success') != null) 
                <p class="success-message ">{{ session('success')}}</p> 
            
            @endif
            <h2>Get in Touch</h2>
            @csrf
            {{-- @guest --}}
            <div class="names">
                <label for="first-name">First Name</label>
                <label for="last-name">Last Name</label>
                <input type="text" name="first-name" id="">
                <input type="text" name="last-name" id="">
            </div>
            <label for="email">Email</label>
            <input type="email" name="email" id="">
            {{-- @endguest --}}
            <label for="query-type">Type of query</label>
            <select name="" id="">
                <option value="order">Book request</option>
                <option value="order">Order issue</option>
                <option value="payment">Payment issue</option>
                <option value="account">Account access</option>
                <option value="other">Other</option>
            </select>
            <label for="message">Message</label>
            <textarea id="message" rows="4" name="text" placeholder="Write your thoughts here..."></textarea>
            <button id="contact-submit-btn" type="submit" class="text-white py-2 px-4 rounded">Send</button>
        </form>
    </div>

    @include('layouts.footer')

    <script>
        document.querySelector('#contact-submit-btn').addEventListener('click', () => {
            if ()
        })
    </script>
</body>

</html>
