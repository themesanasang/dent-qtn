@extends('app')

@section('content')

    <div class="row">      
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li> 
            <li><a href="{!! url('user') !!}">จัดการผู้ใช้</a></li>
            <li class="current"><em>เพิ่มผู้ใช้</em></li>
        </ol>
    </div>

    <div class="row">
     
            <div class="header center">
                เพิ่มผู้ใช้
            </div>
                        
            <div class="form-regis">
            {!! Form::open( array('route' => 'user.store', 'class' => 'col s12 offset-s3') ) !!}	  
                
              <div class="row">
                <div class="input-field col s6">
                  <input placeholder="ชื่อ-นามสกุล" id="name" type="text" name="name">
                    @if($errors->has('name'))
				     <label for="name" class="validate">{!! $errors->first('name') !!} ชื่อ-นามสกุล</label>
                    @else
                       <label for="name">ชื่อ-นามสกุล</label>
                    @endif	
                </div>
              </div>
             <div class="row">
             <div class="input-field col s6">
                  <input placeholder="ชื่อผู้ใช้งาน" id="username" name="username" type="text">
                   @if($errors->has('name'))
				     <label for="username" class="validate">{!! $errors->first('name') !!} ชื่อผู้ใช้งาน</label>
                    @else
                       <label for="username">ชื่อผู้ใช้งาน</label>
                    @endif	
                </div>       
            </div>
              <div class="row">
                <div class="input-field col s6">
                  <input id="password" type="password" name="password" placeholder="รหัสผ่าน">
                     @if($errors->has('name'))
				              <label for="password" class="validate">{!! $errors->first('name') !!} รหัสผ่าน</label>
                    @else
                       <label for="password">รหัสผ่าน</label>
                    @endif	
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input placeholder="ที่อยู" id="address" name="address" type="text">
                  <label for="email">ที่อยู</label>
                </div>
              </div>

              <div class="row">
                  <div class="col s6">
                      <label id="er-chwpart">จังหวัด:</label>
                      {!! Form::select('chwpart', [null=>'กรุณาเลือก'] + $province, null, ['id' => 'u-chwpart', 'class' => 'browser-default']) !!}
                  </div>
              </div>
              <div class="row"> 
                <div class="col s6"> 
                     <label id="er-amppart">อำเภอ:</label>
                     <select name="amppart" id="u-amppart" class="browser-default">
                         <option value="" disabled selected>กรุณาเลือก</option>                                        
                     </select>                       
                  </div>
              </div>
              <div class="row"> 
                <div class="col s6">
                      <label id="er-tmbpart">ตำบล:</label>
                     <select name="tmbpart" id="u-tmbpart" class="browser-default">
                          <option value="" disabled selected>กรุณาเลือก</option>                          
                     </select>                       
                  </div>
              </div>

              <div class="row">  
                  <div class="input-field col s6">
                      <label> ทำงานที่: </label>
                      <br>
                      <p>
                          <input class="with-gap" value="0" name="workat" type="radio" id="workat1" checked />
                          <label for="workat1">โรงพยาบาลส่งเสริมสุขภาพตำบล</label>
                      </p> 
                      <p>
                          <input class="with-gap" value="1" name="workat" type="radio" id="workat2" />
                          <label for="workat2">โรงพยาบาลชุมชน</label>
                      </p> 
                      <p>
                          <input class="with-gap" value="2" name="workat" type="radio" id="workat3" />
                          <label for="workat3">โรงพยาบาลทั่วไป</label>
                      </p> 
                      <p>
                          <input class="with-gap" value="3" name="workat" type="radio" id="workat4" />
                          <label for="workat4">โรงพยาบาลศูนย์</label>
                      </p> 
                  </div>
              </div>
            
              <div class="row">  
                  <div class="input-field col s6">
                       <label> สถานะการใช้งาน: </label>
                       <br>
                      <p>
                        <input class="with-gap" value="1" name="activated" type="radio" id="activated1" checked />
                        <label for="activated1">เปิด ใช้งาน</label>
                      </p> 
                        <p>
                        <input class="with-gap" value="0" name="activated" type="radio" id="activated2" />
                        <label for="activated2">ปิด ใช้งาน</label>
                      </p> 
                  </div>
              </div>      
                
              <div class="row"> 
                  <div class="input-field col s6">
                        <label> สิทธิ์การใช้งาน: </label>
                        <br>
                      <p>
                        <input class="with-gap" value="3" name="status" type="radio" id="status3" checked />
                        <label for="status3">ผู้คัดกรอง</label>
                      </p> 
                       <p>
                        <input class="with-gap" value="2" name="status" type="radio" id="status2" />
                        <label for="status2">ผู้วิจัย</label>
                      </p> 
                        <p>
                        <input class="with-gap" value="1" name="status" type="radio" id="status1" />
                        <label for="status1">ผู้ดูแลระบบ</label>
                      </p> 
                  </div>
              </div>  
              
             <br>    
             <div class="row"> 
                <div class=" col s6 center">
                <button class="btn waves-effect waves-light" type="submit" name="action">บันทึก
  </button>
                    <a href="{!! url('user') !!}" class="waves-effect waves-light btn grey">ยกเลิก</a>
                </div>
             </div>
                
            {!! Form::close() !!}<!-- form -->
            </div><!-- .form-regis  -->
            
        
        
    </div>

    

@endsection
