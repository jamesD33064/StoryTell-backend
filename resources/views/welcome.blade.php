<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Story Tell</title>

</head>

<body>
    {{-- <audio id="videoPlayer" controls>
        <source src="/streamAudio?progress=0" type="audio/wav">
        Your browser does not support the video tag.
    </audio> --}}


    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script>

        // const url = '/story/getStoryDetail/64cdfb09d8e0e93498033222';
        const url = "http://140.134.37.23:8000/story/getStoryDetail/64ce58ed2f6ef1ad74002243";
        // const url = '/story/getAllStoryInfo';

        function post(){
            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {

                }
            });
        }
        post();

        // function updateVideo(progress) {
        //     $.ajax({
        //         url: '/streamAudio',
        //         method: 'GET',
        //         data: {
        //             progress: progress
        //         },
        //         success: function(data) {
        //             const videoPlayer = document.getElementById('videoPlayer');
        //             videoPlayer.src = URL.createObjectURL(data);
        //             videoPlayer.currentTime = progress;
        //             videoPlayer.play();
        //         },
        //         error: function(error) {
        //             console.error('Failed to update video:', error);
        //         }
        //     });
        // }
        // updateVideo(30); // 假設進度為 30 秒

    </script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.15.2/echo.js"
        integrity="sha512-Sl4N4gyjM9NG4XKXIs6VMJc1wng99fzpFvuQIfiTPS+/WfIl3o4Gw/Vkh9qjV0HAHizA9xSmocpuiqbHy0CjBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script>
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'YOUR_PUSHER_APP_KEY',
            cluster: 'YOUR_PUSHER_APP_CLUSTER',
            encrypted: true,
        });

        window.Echo.private('progress-channel')
            .listen('ProgressUpdated', (e) => {
                const currentTime = e.progress;
                const videoPlayer = document.getElementById('videoPlayer');
                videoPlayer.currentTime = currentTime;
            });
    </script> --}}

</body>

</html>
