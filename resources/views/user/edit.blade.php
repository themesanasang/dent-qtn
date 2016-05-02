@extends('app')

@section('content')

    <div class="row">      
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li> 
            <li><a href="{!! url('user') !!}">จัดการผู้ใช้</a></li>
            <li class="current"><em>แก้ไขผู้ใช้</em></li>
        </ol>
    </div>

    <div class="row">
     
            <div class="header center">
                @if( Session::get('status') == '1' )
                    แก้ไขผู้ใช้
                @else
                    แก้ไขข้อมูลส่วนตัว
                @endif
            </div>
                        
            <div class="form-regis">
            {!! Form::open( array('route' => ['user.update', e($user->id)], 'class' => 'col s12 offset-s3', 'method' => 'PATCH') ) !!}	  
                
              <div class="row">
                <div class="input-field col s6">
                  <input placeholder="ชื่อ-นามสกุล" id="name" type="text" name="name" value="{!! $user->name !!}">
                    @if($errors->has('name'))
				     <label for="name" class="validate">{!! $errors->first('name') !!} ชื่อ-นามสกุล</label>
                    @else
                       <label for="name">ชื่อ-นามสกุล</label>
                    @endif	
                </div>
              </div>
             <div class="row">
               <div class="input-field col s6">
                  <input placeholder="ชื่อผู้ใช้งาน" id="username" name="username" type="text" value="{!! $user->username !!}" disabled>
                 <label for="username">ชื่อผู้ใช้งาน</label>
              </div>       
             </div>
              <div class="row">
                <div class="input-field col s6">
                    <input id="password" type="password" name="password" placeholder="รหัสผ่าน">
                    <label for="password">รหัสผ่าน</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input placeholder="ที่อยูเช่น โรงพยาบาล หรือ รพสต." id="address" name="address" type="text" value="{!! $user->address !!}">
                  <label for="email">ที่อยู</label>
                </div>
              </div>

              <div class="row">
                  <div class="col s6">
                      <label id="er-chwpart">จังหวัด:</label>
                      {!! Form::select('chwpart', [null=>$nProvince->PROVINCE_NAME] + $province, null, ['id' => 'ue-chwpart', 'class' => 'browser-default']) !!}
                  </div>
              </div>
              <div class="row"> 
                <div class="col s6"> 
                     <label id="er-amppart">อำเภอ:</label>
                     <select name="amppart" id="ue-amppart" class="browser-default">
                          <option value="" disabled selected>{!! $nAmphur->AMPHUR_NAME !!}</option>                                        
                    </select>                       
                  </div>
              </div>
              <div class="row"> 
                <div class="col s6">
                      <label id="er-tmbpart">ตำบล:</label>
                     <select name="tmbpart" id="ue-tmbpart" class="browser-default">
                          <option value="" disabled selected>{!! $nDistrict->DISTRICT_NAME !!}</option>                          
                      </select>                       
                  </div>
              </div>

            @if( Session::get('status') == '1' )
              <div class="row">  
                  <div class="input-field col s6">
                      <label> ทำงานที่: </label>
                      <br>
                      <p>
                          {!! Form::radio('workat', '0', $user->workat == 0, ['class' => 'with-gap', 'id' => 'workat1']) !!}  
                          <label for="workat1">โรงพยาบาลส่งเสริมสุขภาพตำบล</label>
                      </p> 
                      <p>
                          {!! Form::radio('workat', '1', $user->workat == 1, ['class' => 'with-gap', 'id' => 'workat2']) !!} 
                          <label for="workat2">โรงพยาบาลชุมชน</label>
                      </p> 
                      <p>
                          {!! Form::radio('workat', '2', $user->workat == 2, ['class' => 'with-gap', 'id' => 'workat3']) !!} 
                          <label for="workat3">โรงพยาบาลทั่วไป</label>
                      </p> 
                      <p>
                          {!! Form::radio('workat', '3', $user->workat == 3, ['class' => 'with-gap', 'id' => 'workat4']) !!} 
                          <label for="workat4">โรงพยาบาลศูนย์</label>
                      </p> 
                  </div>
              </div>
              <div class="row">  
                  <div class="input-field col s6">
                       <label> สถานะการใช้งาน: </label>
                       <br>
                      <p>
                        {!! Form::radio('activated', '1', $user->activated == 1, ['class' => 'with-gap', 'id' => 'activated1']) !!}  
                        <label for="activated1">เปิด ใช้งาน</label>
                      </p> 
                        <p>
                        {!! Form::radio('activated', '0', $user->activated == 0, ['class' => 'with-gap', 'id' => 'activated2']) !!}      
                        <label for="activated2">ปิด ใช้งาน</label>
                      </p> 
                  </div>
              </div>      
                
              <div class="row"> 
                  <div class="input-field col s6">
                        <label> สิทธิ์การใช้งาน: </label>
                        <br>
                      <p>
                        {!! Form::radio('status', '3', $user->status == 3, ['class' => 'with-gap', 'id' => 'status3']) !!}    
                        <label for="status3">ผู้คัดกรอง</label>
                      </p> 
                       <p>
                        {!! Form::radio('status', '2', $user->status == 2, ['class' => 'with-gap', 'id' => 'status2']) !!}     
                        <label for="status2">ผู้วิจัย</label>
                      </p> 
                        <p>
                        {!! Form::radio('status', '1', $user->status == 1, ['class' => 'with-gap', 'id' => 'status1']) !!}      
                        <label for="status1">ผู้ดูแลระบบ</label>
                      </p> 
                  </div>
              </div> 
              @endif    
              
             <br>    
             <div class="row"> 
                <div class=" col s6 center">
                <button class="btn waves-effect waves-light" type="submit" name="action">บันทึก
  </button>
                @if( Session::get('status') == '1' )
                    <a href="{!! url('user') !!}" class="waves-effect waves-light btn grey">ยกเลิก</a>
                @else
                   <a href="{!! url('/') !!}" class="waves-effect waves-light btn grey">ยกเลิก</a>
                @endif
                   
                </div>
             </div>
                
            {!! Form::close() !!}<!-- form -->
            </div><!-- .form-regis  -->
            
        
        
    </div>

    

@endsection
