@extends('auth.dashboard')

@section('content')
<style>
 .container {
  width: 1000px;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.card {
  flex: 0 0 calc(33.33% - 40px);
  position: relative;
  margin: 20px;
}

.face {
  /* Remove the fixed width */
  height: 200px;
  transition: 0.4s;
}

.face1 {
  position: relative;
  background: linear-gradient(360deg, transparent, #03e9f4); /* Change the background to a linear gradient */
  display: flex;
  justify-content: center;
  align-content: center;
  align-items: center;
  z-index: 1;
  transform: translateY(100px);
}

.card:hover .face1 {
  transform: translateY(0);
  box-shadow: inset 0 0 60px whitesmoke, inset 20px 0 80px #f0f, inset -20px 0 80px #0ff, inset 20px 0 300px #f0f, inset -20px 0 300px #0ff, 0 0 50px #fff, -10px 0 80px #f0f, 10px 0 80px #0ff;
}

.face1 .content {
  opacity: 0.2;
  transition: 0.5s;
  text-align: center;
}

.card:hover .face1 .content {
  opacity: 1;
}

.face1 .content i {
  font-size: 3em;
  color: white;
  display: inline-block;
}

.face1 .content h3 {
  font-size: 1em;
  color: white;
  text-align: center;
}

.face1 .content a {
  transition: 0.5s;
}

.face2 {
  position: relative;
  background: whitesmoke;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  box-sizing: border-box;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
  transform: translateY(-100px);
}

.card:hover .face2 {
  transform: translateY(0);
}

.face2 .content p,
.face2 .content a {
  font-size: 10pt;
  margin: 0;
  padding: 0;
  color: #333;
}

.face2 .content a {
  text-decoration: none;
  color: black;
  box-sizing: border-box;
  outline: 1px dashed #333;
  padding: 10px;
  margin: 15px 0 0;
  display: inline-block;
}

.face2 .content a:hover {
  background: #333;
  color: whitesmoke;
  box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.text-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.text-container h1 {
  margin-right: 20px;
}

</style>

<div class="text-container">
  <h1>Hello, {{ auth()->user()->name }}!</h1>
  <p>Welcome to our website. We are glad to have you here.</p>
</div>

<div class="container">
  <div class="card">
    <div class="face face1">
      <div class="content">
        <a href="{{ route('p12.form') }}">
          <img src="https://i.ibb.co/8NF8S13/signature.png" alt="signature" border="0" width="75" height="75">
        </a>
        <h3>Upload p12</h3>
      </div>
    </div>
    <div class="face face2">
      <div class="content">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde ab repudiandae, explicabo voluptate et hic cum ratione a. Officia delectus illum perferendis maiores quia molestias vitae fugiat aspernatur alias corporis?
        </p>
        <a href="{{ route('p12.form') }}">Read More</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="face face1">
      <div class="content">
        <a href="{{ route('upload.form') }}">
          <img src="https://i.ibb.co/HN6Q0sj/download-2.png" alt="download-2" border="0" width="75" height="75">
        </a>
        <h3>Upload PDF</h3>
      </div>
    </div>
    <div class="face face2">
      <div class="content">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde ab repudiandae, explicabo voluptate et hic cum ratione a. Officia delectus illum perferendis maiores quia molestias vitae fugiat aspernatur alias corporis?
        </p>
        <a href="{{ route('upload.form') }}">Read More</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="face face1">
      <div class="content">
        <a href="{{ route('verify.upload.pdf') }}">
          <img src="https://i.ibb.co/9nMznVP/verified.png" alt="verified" border="0" width="75" height="75">
        </a>
        <h3>Verify</h3>
      </div>
    </div>
    <div class="face face2">
      <div class="content">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde ab repudiandae, explicabo voluptate et hic cum ratione a. Officia delectus illum perferendis maiores quia molestias vitae fugiat aspernatur alias corporis?
        </p>
        <a href="{{ route('verify.upload.pdf') }}">Read More</a>
      </div>
    </div>
  </div>
</div>
@endsection
