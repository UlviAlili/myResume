@extends('layouts.front')
@section("title","Contact")

@section("css")

@endsection

@section("content")
    <section class="contact-section">
        <h2 class="section-title">GET IN TOUCH</h2>
        <p class="mb-4">If you’d like to talk about a project, our work or anything else then get in touch.</p>

        <div class="contact-cards-wrapper">
            <div class="contact-card">
                <h6 class="contact-card-title">CALL ME</h6>
                <p class="contact-card-content">+994 50 412 19 07</p>
            </div>
            <div class="contact-card">
                <h6 class="contact-card-title">Email Me</h6>
                <p class="contact-card-content">Ulvi96alili@gmail.com</p>
            </div>
        </div>

        <form action="{{route('mail')}}" method="post" class="contact-form" id="mailForm">
            @csrf
            <div class="form-group form-group-name">
                <label for="name" class="sr-only">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="NAME">
            </div>
            <div class="form-group form-group-email">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="EMAIL">
            </div>
            <div class="form-group">
                <label for="message" class="sr-only">Message</label>
                <textarea name="message" id="message" class="form-control" placeholder="MESSAGE" rows="5"></textarea>
            </div>
            <button type="button" class="btn btn-primary form-submit-btn" id="send">SEND MESSAGE</button>
        </form>

    </section>
    <section class="location-section">
        <h5 class="section-title">MY LOCATION</h5>

        <div class="map-wrapper embed-responsive embed-responsive-16by9">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96970.1493416501!2d49.54867967290636!3d40.57875402552635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x403096dcd0923f6b%3A0xdf4767c369322a71!2zU3VtcWF5xLF0!5e0!3m2!1str!2saz!4v1681997365092!5m2!1str!2saz"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
@endsection

@section("js")
    <script src="{{asset("assets/vendors/entry/jq.entry.min.js")}}"></script>
    <script>
        function isEmail(email) {
            let regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return regex.test(email);
        }

        $('#send').click(function () {
            if ($('#name').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Name can't be empty",
                })
            } else if ($('#email').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Email can't be empty",
                })
            } else if (!isEmail($('#email').val().trim())) {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Email is not correct",
                })
            } else if ($('#message').val().trim() === "") {
                Swal.fire({
                    icon: 'info',
                    title: 'Warning!',
                    text: "Message can't be empty",
                })
            } else {
                $('#mailForm').submit();
            }
        });
    </script>
@endsection
