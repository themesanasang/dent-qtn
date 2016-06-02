@extends('app')

@section('content')
    <div class="row">      
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('patient') !!}">หน้าหลัก</a></li> 
            <li class="current"><em>แก้ไขทะเบียน</em></li>
        </ol>
    </div>

    <div class="row">
                        
            <div class="form-regis">
            {!! Form::open( array('route' => ['patient.update', e($patient->id)], 'class' => 'col s12 offset-s3', 'method' => 'PATCH') ) !!}	  
                
              <div class="row">
                <div class="input-field col s6">
                  <input placeholder="ชื่อ-นามสกุล" type="text" id="fullname" name="fullname" value="{!! $patient->fullname !!}">
                    @if($errors->has('fullname'))
				               <label for="fullname" class="validate">{!! $errors->first('fullname') !!} ชื่อ-นามสกุล</label>
                    @else
                       <label for="fullname">ชื่อ-นามสกุล</label>
                    @endif	
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input placeholder="ที่อยู" id="address" name="address" type="text" value="{!! $patient->address !!}">
                  <label for="address">ที่อยู</label>
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

              <div class="row">
                <div class="input-field col s6">
                  <input placeholder="ที่อยู" name="mobile" type="text" value="{!! $patient->mobile !!}">
                  <label for="mobile">เบอร์โทรศัพท์</label>
                </div>
              </div>  

              <div class="row">
                <div class="input-field col s6">
                  <label for="discharge">23.วันทีจำหน่าย่(ว-ด-ป)</label>    
                      <input id="discharge" name="discharge" type="text" class="datepicker picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo (( ($patient->discharge != null) && ($patient->discharge != '0000-00-00 00:00:00') )?date("d-m-Y", strtotime($patient->discharge)):""); ?>" /> 
                </div>
              </div>  

             <br>    
             <div class="row"> 
                <div class=" col s6 center">
                  <button class="btn waves-effect waves-light" type="submit" name="action">บันทึก</button>
                  <a href="{!! url('patient') !!}" class="waves-effect waves-light btn grey">ยกเลิก</a>
                </div>
             </div>
                
            {!! Form::close() !!}<!-- form -->
            </div><!-- .form-regis  -->
                    
    </div>
@endsection
