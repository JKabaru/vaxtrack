@extends('layouts.app')

@section('content')

<div class="container">
  <header>
    <h1>VaxTrack</h1>
    <p>Streamlining immunization</p>
  </header>
  <main>
    <section class="hero">
      <div class="hero-content">
        <h2>VaxTrack</h2>
        <p>A web-based application that helps parents track their child's vaccination status.</p>
        <a href="/register" class="btn btn-primary">Sign Up</a>
      </div>
    </section>
    <section class="features">
      <div class="row">
        <div class="col-md-4">
          <div class="feature">
            <i class="fa fa-check"></i>
            <h3>Easy to use</h3>
            <p>VaxTrack is easy to use and can be accessed from any device with an internet connection.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature">
            <i class="fa fa-database"></i>
            <h3>Centralized storage</h3>
            <p>VaxTrack provides parents with a central location to store their child's vaccination records.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature">
            <i class="fa fa-bell"></i>
            <h3>Reminders</h3>
            <p>VaxTrack sends reminders to parents when their child is due for a vaccination.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="call-to-action">
      <h2>Get started today</h2>
      <p>Sign up for VaxTrack and start tracking your child's vaccination status.</p>
      <a href="/register" class="btn btn-primary">Sign Up</a>
    </section>
  </main>
  <footer>
    <p>Copyright &copy; 2023 VaxTrack</p>
  </footer>
</div>

@endsection

<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

  .container {
    background-color: #ffffff;
    padding: 20px;
  }

  h1 {
    font-size: 24px;
    margin-bottom: 10px;
  }

  p {
    font-size: 16px;
  }

  .hero {
    background-image: url('https://bootstrapmade.com/demo/scaffold/img/hero.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    height: 500px;
  }

  .hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 500px;
    padding: 20px;
    color: #fff;
  }

  .features {
    margin-top: 60px;
  }

  .feature {
    margin-bottom: 20px;
  }

  .feature i {
    font-size: 36px;
  }

  .call-to-action {
    margin-top: 60px;
  }

  .btn {
    width: 100%;
  }
</style>
