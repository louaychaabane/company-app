@extends('layouts.main')
@section('content')
    <div class="about-me-container">
        <img src="{{ asset('/images/louay.jpg') }}" alt="" class="about-img">
        <div class="about-txt">
            <h1>Louay Chaabane</h1>
            <div class="role">
                <span class="text first-text">I'm a</span>
                <span class="text sec-text">Freelancer</span>
            </div>
            <p>
                My name is Louay Chaabane, and I am a second-year software engineering student, graphic designer, and web developer. With a fondness for gaming and a deep appreciation for food, I find inspiration in virtual worlds and diverse culinary experiences. Through my creative mindset and technical skills, I strive to craft visually captivating designs and develop immersive web experiences. I am committed to continuous growth and look forward to making a meaningful contribution in the dynamic field of design and technology.
            </p>
            <div class="about-social-media">
                <ul>
                    <li>
                      <a class="facebook" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                        <a class="instagram" href="#">
                          <span></span>
                          <span></span>
                          <span></span>
                          <span></span>
                          <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                      </li>
                    <li>
                      <a class="behance" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <i class="fa fa-behance" aria-hidden="true"></i>
                      </a>
                    </li>
                    
                    <li>
                      <a class="google" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
            </div>
            <script src="{{ asset('/js/typewriter.js') }}"></script>
        </div>
    </div>
@endsection
