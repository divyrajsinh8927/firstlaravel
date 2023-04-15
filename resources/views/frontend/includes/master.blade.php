@include('frontend.includes.header')
<!-- header area end -->
@php $baseurl = json_encode(url('/')); @endphp

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    function getSiteUrl() {
        var BASE_URL = "<?php $baseurl; ?>";
        return BASE_URL;
    }

    var firebaseConfig = {
        apiKey: "AIzaSyD-diidBNa6h64kY9GBfC9S9Ucf0ups4Hc",
        authDomain: "fashon-4dcea.firebaseapp.com",
        projectId: "fashon-4dcea",
        storageBucket: "fashon-4dcea.appspot.com",
        messagingSenderId: "94436826526",
        appId: "1:94436826526:web:ae2f44e2513d68e9530a8f",
        measurementId: "G-9LPMV1S7WS"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("store.token") }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        alert('Token stored.');
                    },
                    error: function(error) {
                        alert(error);
                    },
                });
            }).catch(function(error) {
                alert(error);
            });
    }
    messaging.onMessage(function(payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
</script>
@yield('frontend')
@include('frontend.includes.footer')
