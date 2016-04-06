@extends('applogin')

@section('content')

<div class="login card">  
    <div class="row">
        
        <h5 class="center">เข้าสู่ระบบ</h5>
        
        @if(Session::has('error'))			
        <div id="error-login" class="validate">         			  
            <span>{{ e(Session::get('error')) }}</span>
        </div>
        @endif
               
        <form class="col s12" role="form" method="POST" action="login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                      
            <div class="input-field col s12">                           
              <input id="username" name="username" type="text">                           
              <label for="username">ชื่อผู้ใช้</label>
            </div>    
            
            <div class="input-field col s12">
              <input id="password" name="password" type="password">          
              <label for="password">รหัสผ่าน</label>
            </div>   
            
            <div class="col s12 center">      
                <button type="submit" class="waves-effect waves-light btn">
                    เข้าสู่ระบบ
                </button>                                        
            </div> 
            
        </form> 
               
    </div>   
</div>

<div class="login-footer center">
      © 2015 ThemeSanasang, All rights reserved.       
</div>

@endsection
