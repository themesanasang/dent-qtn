@extends('app')

@section('content')

    <div class="row">
        <div class="col s12"> 
                               
            <div class="row">
                <h2 class="col s12 header center">แบบสอบถามเพื่อคัดกรองความเสี่ยงโรคมะเร็งช่องปาก</h2>
            </div>
            
            <div class="center-tab">
            <div class="row">
            <div class="col s12 ">
              <ul class="tabs content-tab">
                <li class="tab-top tab col s3"><a href="#tab1">ส่วนที่ 1</a></li>
                <li class="tab-top tab col s3"><a href="#tab2">ส่วนที่ 2</a></li>
                <li class="tab-top tab col s3"><a href="#tab3">ส่วนที่ 3</a></li>
                 
                 @if( Session::get('status') == '1' || Session::get('status') == '2' ) 
                    <li class="tab-top tab col s3"><a href="#tab4">ส่วนที่ 4</a></li>
                 @endif 

                 <li class="tab-top tab col s3"><a href="#tab5">ข้อมูลอื่น ๆ</a></li> 
              </ul>
            </div>
            </div>
            </div>
                
            
            {!! Form::open( array('route' => ['screen.update', e($screen->id)], 'class' => 'form-horizontal', 'method' => 'PATCH', 'files'=>true) ) !!}
            
            <!-- ============== Part 1 =============== -->
            <!-- ============== Part 1 =============== -->
            <!-- ============== Part 1 =============== -->
            <div id="tab1" class="row">
            <h4 class="header part center">ส่วนที่ 1 ข้อมูลทั่วไป</h4>
            <div class="form-body">
                <div class="row">
                    <div class="input-field col s12">
                      <input name="fullname" type="text" value="{!! $screen->fullname !!}" disabled>                      
                      <label for="fullname">1.ชื่อ-สกุล</label>                          
                    </div>                                                         
                </div><!-- fullname -->  
                
                <div class="row">                                             
                    <div class="input-field col s12">
                      <input name="cid" type="text" value="{!! $screen->cid !!}" disabled>
                      <label for="cid">2.เลขบัตรประชาชน</label>
                    </div>              
                </div><!-- cid -->   
                
                <div class="row">
                    <div class="input-field col s12">
                      <input name="age" id="e-age" type="text" value="{!! $screen->age !!}">
                      <label for="e-age">3.อายุ<label>
                    </div>              
                </div><!-- age --> 
                        
                <div class="row">
                     <div class="input-field col s12">                     
                     <label>4.เพศ:</label>
                         <br />
                      <p>      
                          <div class="col m2 s12">  
                              {!! Form::radio('sex', '1', $screen->sex == 1, ['id' => 'e-sex1']) !!} 
                              <label for="e-sex1">1.ชาย</label>
                          </div>
                          <div class="col m2 s12">
                              {!! Form::radio('sex', '2', $screen->sex == 2, ['id' => 'e-sex2']) !!} 
                              <label for="e-sex2">2.หญิง</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- sex --> 
                        
                <div class="row">
                   <div class="input-field col s12">                     
                     <label>5.สถานภาพสมรส:</label>
                     <br />
                      <p>      
                          <div class="col m3 s12">
                              {!! Form::radio('status', '1', $screen->status == 1, ['id' => 'e-status1']) !!}
                              <label for="e-status1">1.โสด</label>
                          </div>
                         <div class="col m3 s12">
                              {!! Form::radio('status', '2', $screen->status == 2, ['id' => 'e-status2']) !!}
                              <label for="e-status2">2.สมรส</label>
                          </div>
                          <div class="col m3 s12">
                              {!! Form::radio('status', '3', $screen->status == 3, ['id' => 'e-status3']) !!}
                              <label for="e-status3">3.หย่าร้าง</label>
                          </div>
                         <div class="col m3 s12">
                              {!! Form::radio('status', '4', $screen->status == 4, ['id' => 'e-status4']) !!}
                              <label for="e-status4">4.หม้าย</label>
                         </div>
                      </p>                         
                    </div>
                </div><!-- status --> 
                        
                <div class="row">
                    <div class="input-field col s12">                     
                     <label>6.ระดับการศึกษา:</label>
                     <br />
                      <p>
                          <div class="col m5 s12">
                              {!! Form::radio('school', '1', $screen->school == 1, ['id' => 'e-school1']) !!}
                              <label for="e-school1">1.ประถม</label>   
                          </div>  
                          <div class="col m7 s12">
                              {!! Form::radio('school', '2', $screen->school == 2, ['id' => 'e-school2']) !!}
                              <label for="e-school2">2.มัธยม / ปวช</label>   
                          </div> 

                          <div class="col m5 s12">
                              {!! Form::radio('school', '3', $screen->school == 3, ['id' => 'e-school3']) !!}
                              <label for="e-school3">3.ปวท / ปวส</label>   
                          </div>  
                          <div class="col m7 s12">
                              {!! Form::radio('school', '4', $screen->school == 4, ['id' => 'e-school4']) !!}
                              <label for="e-school4">4.ปริญญาตรี</label>   
                          </div>  

                          <div class="col m5 s12">
                              {!! Form::radio('school', '5', $screen->school == 5, ['id' => 'e-school5']) !!}
                              <label for="e-school5">5.สูงกว่าปริญญาตรี</label>   
                          </div>  
                          <div class="col m7 s12">                           
                              {!! Form::radio('school', '6', $screen->school == 6, ['id' => 'e-school6']) !!}
                              <label for="e-school6">6.อื่น ๆ ระบุ</label>                                               
                          </div>
                      </p>
                    </div>
                </div><!-- school --> 
                <div class="row">                  
                    <div class="input-field col s12">
                          <input placeholder="โปรดระบุ" id="e-textschool" name="textschool" type="text" value="{!! $screen->textschool !!}">     
                    </div>         
                </div><!-- textschool -->  
                        
                <div class="row">
                    <div class="input-field col s12">                     
                     <label>7.อาชีพ:</label>
                     <br />
                     <p>    
                          <div class="col m5 s12">
                              {!! Form::radio('work', '1', $screen->work == 1, ['id' => 'e-work1']) !!}
                              <label for="e-work1">1.เกษตรกร</label>   
                          </div>  
                          <div class="col m7 s12">
                              {!! Form::radio('work', '2', $screen->work == 2, ['id' => 'e-work2']) !!}
                              <label for="e-work2">2.รับจ้าง</label>   
                          </div> 

                          <div class="col m5 s12">
                              {!! Form::radio('work', '3', $screen->work == 3, ['id' => 'e-work3']) !!}
                              <label for="e-work3">3.พนักงานบริษัท</label>   
                          </div>  
                          <div class="col m7 s12">
                              {!! Form::radio('work', '4', $screen->work == 4, ['id' => 'e-work4']) !!}
                              <label for="e-work4">4.ค้าขาย / ธุรกิจส่วนตัว</label>   
                          </div>  

                          <div class="col m5 s12">
                              {!! Form::radio('work', '5', $screen->work == 5, ['id' => 'e-work5']) !!}
                              <label for="e-work5">5.พนักงานราชการ / ราชการ</label>   
                          </div>  
                          <div class="col m7 s12">                           
                              {!! Form::radio('work', '6', $screen->work == 6, ['id' => 'e-work6']) !!}
                              <label for="e-work6">6.อื่น ๆ ระบุ</label>                                               
                          </div> 
                      </p>
                    </div>
                </div><!-- work --> 
                <div class="row">                    
                    <div class="input-field col s12">
                          <input placeholder="โปรดระบุ" id="e-textwork" name="textwork" type="text" value="{!! $screen->textwork !!}">     
                    </div>         
                </div><!-- textwork -->  
                
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="e-textarea1" class="materialize-textarea" name="address">{!! $screen->address !!}</textarea>
                        <label for="e-textarea1">8.ที่อยู่</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col l4 s12">
                        <label>จังหวัด:</label>
                        @if( $nProvince != '' )
                          {!! Form::select('chwpart', [null=>$nProvince->PROVINCE_NAME] + $province, null, ['id' => 'e-chwpart', 'class' => 'browser-default']) !!}
                        @else
                          {!! Form::select('chwpart', [null=>'กรุณาเลือก'] + $province, null, ['id' => 'e-chwpart', 'class' => 'browser-default']) !!}
                        @endif
                    </div>
                    <div class="col l4 s12"> 
                       <label>อำเภอ:</label>
                       <select name="amppart" id="e-amppart" class="browser-default">
                          @if( $nProvince != '' )
                            <option value="" disabled selected>{!! $nAmphur->AMPHUR_NAME !!}</option>  
                          @else
                            <option value="" disabled selected>กรุณาเลือก</option>  
                          @endif                                                                 
                       </select>                       
                    </div>
                    <div class="col l4 s12">
                        <label>ตำบล:</label>
                       <select name="tmbpart" id="e-tmbpart" class="browser-default">                              
                          @if( $nProvince != '' )
                            <option value="" disabled selected>{!! $nDistrict->DISTRICT_NAME !!}</option> 
                          @else
                            <option value="" disabled selected>กรุณาเลือก</option>  
                          @endif                          
                       </select>                       
                    </div>
                </div> <!-- address --> 
                
                <div class="row">
                    <div class="input-field col l6 s12">
                      <input name="tel" id="e-tel" type="text" value="{!! $screen->tel !!}">
                      <label for="e-tel">9.โทรศัพท์</label>
                    </div>
                    <div class="input-field col l6 s12">
                      <input name="mobile" id="e-mobile" type="text" value="{!! $screen->mobile !!}">
                      <label for="e-mobile">มือถือ</label>
                    </div>
                </div> <!-- ติดต่อ -->                 
                                        
            </div><!-- .form-body 1 -->
            </div>
            

            <!-- ============== Part 2 =============== -->
            <!-- ============== Part 2 =============== -->
            <!-- ============== Part 2 =============== -->
            <div id="tab2" class="row">
            <h4 class="header part center">ส่วนที่ 2 ปัจจัยเสี่ยงมะเร็งช่องปาก</h4>
            <div class="form-body">
                
                <div class="row">
                     <div class="input-field">    
                        <label>10.ปัจจุบันท่านสูบบุหรี่หรือไม่:</label>
                     </div>
                    <div class="col s12">                    
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              {!! Form::radio('smoking', '1', $screen->smoking == 1, ['id' => 'e-smoking1']) !!}
                              <label for="e-smoking1">1.ไม่สูบ</label>   
                          </div>                          
                          <div class="col s12">
                              {!! Form::radio('smoking', '2', $screen->smoking == 2, ['id' => 'e-smoking2']) !!}
                              <label for="e-smoking2">2.สูบ</label>   
                          </div>  
                          <div class="input-field col l6 s12">                              
                              <input name="smokingday" id="e-smokingday" type="text" value="{!! $screen->smokingday !!}">   
                              <label for="e-smokingday">ท่านสูบบุหรี่วันละ กี่มวน</label>
                          </div>
                          <div class="input-field col l6 s12">                                
                              <input name="smokinglong" id="e-smokinglong" type="text" value="{!! $screen->smokinglong !!}">  
                              <label for="e-smokinglong">สูบบุหรี่มานาน กี่ปี</label>
                          </div> 

                          <div class="col s12">
                              {!! Form::radio('smoking', '3', $screen->smoking == 3, ['id' => 'e-smoking3']) !!}
                              <label for="e-smoking3">3.เคยสูบ( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="smokingstop" id="e-smokingstop" type="text" value="{!! $screen->smokingstop !!}">   
                                <label for="e-smokingstop">ท่านเลิกสูบบุหรี่มานาน กี่ปี</label>
                          </div> 
                      </p>
                    </div>
                </div><!-- smoking --> 
            
                <div class="row">
                     <div class="input-field col s12">                     
                     <label>11.มีบุคคลที่พักอาศัยในบ้านสูบบุหรี่หรือไม่:</label>
                     <br />
                      <p>     
                          <div class="col m2 s12"> 
                              {!! Form::radio('hassmoking', '1', $screen->hassmoking == 1, ['id' => 'e-hassmoking1']) !!}
                              <label for="e-hassmoking1">1.มี</label>
                          </div>
                          <div class="col m2 s12">
                              {!! Form::radio('hassmoking', '2', $screen->hassmoking == 2, ['id' => 'e-hassmoking2']) !!}
                              <label for="e-hassmoking2">2.ไม่มี</label>
                          </div>
                      </p>                         
                    </div>                                       
                </div><!-- hassmoking --> 

                 <div class="row">
                     <div class="input-field">    
                        <label>12.ปัจจุบันท่านใช้ยานัตถุ์ / ยาเส้นหรือไม่:</label>
                     </div>
                    <div class="col s12">                       
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              {!! Form::radio('hasnus', '1', $screen->hasnus == 1, ['id' => 'e-hasnus1']) !!}
                              <label for="e-hasnus1">1.ไม่ใช้</label>   
                          </div>                          
                          <div class="col s12">
                              {!! Form::radio('hasnus', '2', $screen->hasnus == 2, ['id' => 'e-hasnus2']) !!}
                              <label for="e-hasnus2">2.ใช้</label>   
                          </div>  
                          <div class="input-field col s12">                              
                              <input name="nuslong" id="e-nuslong" type="text" value="{!! $screen->nuslong !!}">   
                              <label for="e-nuslong">ใช้ยานัต์ / ยาเส้นมานาน กี่ปี</label>
                          </div> 
                          <div class="col s12">
                              {!! Form::radio('hasnus', '2', $screen->hasnus == 2, ['id' => 'e-hasnus3']) !!}
                              <label for="e-hasnus3">3.เคยใช้( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="nusstop" id="e-nusstop" type="text" value="{!! $screen->nusstop !!}"> 
                                <label for="e-nusstop">เลิกใช้ยานัต์ / ยาเส้นมานาน กี่ปี</label>
                          </div> 
                      </p>
                    </div>
                </div><!-- hasnus -->

                <div class="row">
                    <div class="input-field">    
                        <label>13.ปัจจุบันท่านเคี้ยวหมากหรือไม่:</label>
                     </div>
                    <div class="col s12">                       
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              {!! Form::radio('hasareca', '1', $screen->hasareca == 1, ['id' => 'e-hasareca1']) !!}
                              <label for="e-hasareca1">1.ไม่เคี้ยว</label>   
                          </div>                          
                          <div class="col s12">
                              {!! Form::radio('hasareca', '2', $screen->hasareca == 2, ['id' => 'e-hasareca2']) !!}
                              <label for="e-hasareca2">2.เคี้ยว</label>   
                          </div>  
                          <div class="input-field col s12">                              
                              <input name="arecalong" id="e-arecalong" type="text" value="{!! $screen->arecalong !!}">   
                              <label for="e-arecalong">เคี้ยวหมากมานาน กี่ปี</label>
                          </div> 
                          <div class="col s12">
                              {!! Form::radio('hasareca', '3', $screen->hasareca == 3, ['id' => 'e-hasareca3']) !!}
                              <label for="e-hasareca3">3.เคยเคี้ยว( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="arecastop" id="e-arecastop" type="text" value="{!! $screen->arecastop !!}">    
                                <label for="e-arecastop">เลิกเคี้ยวหมากมานาน กี่ปี</label> 
                          </div> 
                      </p>
                    </div>
                </div><!-- hasareca -->

                <div class="row">
                    <div class="input-field">    
                        <label>14.ปัจจุบันท่านดืมเครื่องดืมผสมแอลกอฮอล์หรือไม่:</label>
                     </div>
                    <div class="col s12">                       
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              {!! Form::radio('alcohol', '1', $screen->alcohol == 1, ['id' => 'e-alcohol1']) !!}
                              <label for="e-alcohol1">1.ไม่ดื่ม</label>   
                          </div>                          
                          <div class="col s12">
                              {!! Form::radio('alcohol', '2', $screen->alcohol == 2, ['id' => 'e-alcohol2']) !!}
                              <label for="e-alcohol2">2.ดื่ม</label>   
                          </div>
                        
                         <div id="alcohol_child">
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>ท่านเครื่องดื่มชนิดใด:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="col s12">
                                          {!! Form::radio('drinktype', '1', $screen->drinktype == 1, ['id' => 'e-drinktype1']) !!}
                                          <label for="e-drinktype1">1.เหล้าขาว</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinktype', '2', $screen->drinktype == 2, ['id' => 'e-drinktype2']) !!}
                                          <label for="e-drinktype2">2.เหล้าสี</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinktype', '3', $screen->drinktype == 3, ['id' => 'e-drinktype3']) !!}
                                          <label for="e-drinktype3">3.เบียร์</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinktype', '4', $screen->drinktype == 4, ['id' => 'e-drinktype4']) !!}
                                          <label for="e-drinktype4">4.ไวน์</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinktype', '5', $screen->drinktype == 5, ['id' => 'e-drinktype5']) !!}
                                          <label for="e-drinktype5">5.อื่น ๆ ระบุ</label>   
                                      </div>
                                      <div class="input-field col s12">                                        
                                          <input name="drinktypetext" id="e-drinktypetext" type="text" value="{!! $screen->drinktypetext !!}">
                                          <label for="e-drinktypetext">โปรดระบุ</label> 
                                      </div> 
                                </p>
                           </div>
                         </div>    
                         <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>ท่านดื่มวันละ:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="input-field col s12">                                        
                                          <input name="drinkunittext" id="e-drinkunittext" type="text" value="{!! $screen->drinkunittext !!}">
                                          <label for="e-drinkunittext">โปรดระบุ</label> 
                                      </div> 
                                      <div class="col s12">
                                          {!! Form::radio('drinkunit', '1', $screen->drinkunit == 1, ['id' => 'e-drinkunit1']) !!}
                                          <label for="e-drinkunit1">1.เป๊ก</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinkunit', '2', $screen->drinkunit == 2, ['id' => 'e-drinkunit2']) !!}
                                          <label for="e-drinkunit2">2.กั๊ก</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinkunit', '3', $screen->drinkunit == 3, ['id' => 'e-drinkunit3']) !!}
                                          <label for="e-drinkunit3">3.แบน</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinkunit', '4', $screen->drinkunit == 4, ['id' => 'e-drinkunit4']) !!}
                                          <label for="e-drinkunit4">4.กระป๋อง</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinkunit', '5', $screen->drinkunit == 5, ['id' => 'e-drinkunit5']) !!}
                                          <label for="e-drinkunit5">5.ขวดเล็ก</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('drinkunit', '6', $screen->drinkunit == 6, ['id' => 'e-drinkunit6']) !!}
                                          <label for="e-drinkunit6">6.ขวดใหญ่</label>   
                                      </div>
                                </p>
                           </div>
                         </div> 
                        <div class="input-field col s12">  
                             <div class="leftup-alcohollong">
                                <input name="alcohollong" id="e-alcohollong" type="text" value="{!! $screen->alcohollong !!}">  
                                 <label for="e-alcohollong">ดื่มมานาน กี่ปี</label>
                            </div>
                        </div> 
                        </div>
                        
                          <div class="col s12">
                              {!! Form::radio('alcohol', '3', $screen->alcohol == 3, ['id' => 'e-alcohol3']) !!}
                              <label for="e-alcohol3">3.เคยดื่ม( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="alcoholstop" id="e-alcoholstop" type="text" value="{!! $screen->alcoholstop !!}"> 
                                <label for="e-alcoholstop">เลิกดื่มมานาน กี่ปี</label> 
                          </div> 
                      </p>
                    </div>
                </div><!-- alcohol -->

               <div class="row">
                     <div class="row">  
                        <div class="input-field">
                        <label>15.ประวัติการป่วยด้วยโรคมะเร็งของบุคคลในครอบครัว (มารดา/บิดา/พี่น้องร่วมบิดามารดา):</label>
                        </div>
                     </div>
                    <div class="show-on-small">
                        <br />
                    </div> 
                    <div class="row">
                    <div class="col s12">
                     <br />
                      <p>     
                          <div class="col s12"> 
                              {!! Form::radio('hascancer', '1', $screen->hascancer == 1, ['id' => 'e-hascancer1']) !!}
                              <label for="e-hascancer1">1.ไม่มี</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('hascancer', '2', $screen->hascancer == 2, ['id' => 'e-hascancer2']) !!}
                              <label for="e-hascancer2">2.มี</label>
                          </div>
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>เป็นมะเร็งชนิดใด:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="col s12">
                                          {!! Form::radio('cancer', '1', $screen->cancer == 1, ['id' => 'e-cancer1']) !!}
                                          <label for="e-cancer1">1.มะเร็งช่องปาก</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('cancer', '2', $screen->cancer == 2, ['id' => 'e-cancer2']) !!}
                                          <label for="e-cancer2">2.มะเร็งโพรงจมูกและคอ</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('cancer', '3', $screen->cancer == 3, ['id' => 'e-cancer3']) !!}
                                          <label for="e-cancer3">3.มะเร็งปอด</label>   
                                      </div>                                     
                                      <div class="col s12">
                                          {!! Form::radio('cancer', '4', $screen->cancer == 4, ['id' => 'e-cancer4']) !!}
                                          <label for="e-cancer4">4.อื่น ๆ ระบุ</label>   
                                      </div>                                 
                                      <div class="input-field col s12">                                        
                                        <input class="textcancer" name="textcancer" id="e-textcancer" type="text" value="{!! $screen->textcancer !!}">
                                        <label class="textcancer" for="e-textcancer">โปรดระบุ</label>  
                                      </div> 
                                </p>
                           </div>
                         </div>    
                      </p>                         
                    </div>   
                    </div>
                </div><!-- hascancer -->

                <div class="row">
                     <div class="input-field">                     
                         <label>16.ทำงานกลางแดดเป็นประจำ:</label>
                     </div>     
                     <div class="col s12"> 
                      <br /><br />     
                      <p>     
                          <div class="col s12"> 
                              {!! Form::radio('sun', '1', $screen->sun == 1, ['id' => 'e-sun1']) !!}
                              <label for="e-sun1">1.ไม่ใช่</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('sun', '2', $screen->sun == 2, ['id' => 'e-sun2']) !!}
                              <label for="e-sun2">2.ใช่</label>
                          </div>
                          <div class="input-field col s12">                                        
                             <input class="worksun" name="worksun" id="e-worksun" type="text" value="{!! $screen->worksun !!}">
                             <label class="worksun" for="e-worksun">อยู่กลางแดดนาน กี่ชั่วโมง/วัน</label> 
                          </div> 
                      </p>                         
                    </div>                                       
                </div><!-- sun -->         
                
            </div><!-- .form-body 2 -->  
            </div>


            <!-- ============== Part 3 =============== -->
            <!-- ============== Part 3 =============== -->
            <!-- ============== Part 3 =============== -->
            <div id="tab3" class="row">
            <h4 class="header part center">ส่วนที่ 3 ผลการตรวจในช่องปาก</h4>
            <div class="form-body">
                
                <div class="row">
                     <div class="input-field col s12">                     
                     <label>17.ฟันคมทำให้ระคายเคือง:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              {!! Form::radio('part3_1', '1', $screen->part3_1 == 1, ['id' => 'e-part3_11']) !!}
                              <label for="e-part3_11">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              {!! Form::radio('part3_1', '2', $screen->part3_1 == 2, ['id' => 'e-part3_12']) !!}
                              <label for="e-part3_12">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_1 --> 

                <div class="row">
                     <div class="input-field col s12">                     
                     <label>18.ระคายเคืองจากฟันปลอม:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              {!! Form::radio('part3_2', '1', $screen->part3_2 == 1, ['id' => 'e-part3_21']) !!}
                              <label for="e-part3_21">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              {!! Form::radio('part3_2', '2', $screen->part3_2 == 2, ['id' => 'e-part3_22']) !!}
                              <label for="e-part3_22">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_2 --> 

                 <div class="row">
                     <div class="input-field col s12">                     
                     <label>19.ฟันผุที่ต้องอุด/ถอน:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              {!! Form::radio('part3_3', '1', $screen->part3_3 == 1, ['id' => 'e-part3_31']) !!}
                              <label for="e-part3_31">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              {!! Form::radio('part3_3', '2', $screen->part3_3 == 2, ['id' => 'e-part3_32']) !!}
                              <label for="e-part3_32">2.ไม่มี</label>
                          </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_3 --> 

                <div class="row">
                     <div class="input-field col s12">                     
                     <label>20.เหงือกบวม แดง มีหินปูน:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              {!! Form::radio('part3_4', '1', $screen->part3_4 == 1, ['id' => 'e-part3_41']) !!}
                              <label for="e-part3_41">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              {!! Form::radio('part3_4', '2', $screen->part3_4 == 2, ['id' => 'e-part3_42']) !!}
                              <label for="e-part3_42">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_4 --> 

                <div class="row">
                     <div class="input-field">                     
                     <label>21.ผลการตรวจเนื้อเยื่ออ่อนในช่องปาก (ริมฝีปากด้านใน-ด้านนอก, เพดานปาก, กระพุ้งแก้มซ้าย-ขวา, ลิ้น, ใต้ลิ้น):</label>
                    </div>
                     <div class="show-on-small">
                        <br /><br />
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                          <div class="col s12"> 
                              {!! Form::radio('part3_5', '1', $screen->part3_5 == 1, ['id' => 'e-part3_51']) !!}
                              <label for="e-part3_51">1.ปกติ</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('part3_5', '2', $screen->part3_5 == 2, ['id' => 'e-part3_52']) !!}
                              <label for="e-part3_52">2.ผิดปกติ</label>
                          </div>
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>พบรอยโรค:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="col s12">
                                          {!! Form::radio('part3_6', '1', $screen->part3_6 == 1, ['id' => 'e-part3_61']) !!}
                                          <label for="e-part3_61">1.รอยโรคสีแดง / ขาวที่ขูดไม่ออก</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('part3_6', '2', $screen->part3_6 == 2, ['id' => 'e-part3_62']) !!}
                                          <label for="e-part3_62">2.แผล (Uleeration)</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('part3_6', '3', $screen->part3_6 == 3, ['id' => 'e-part3_63']) !!}
                                          <label for="e-part3_63">3.ก้อนหรือติ่งเนื้อ</label>   
                                      </div>                                     
                                      <div class="col s12">
                                          {!! Form::radio('part3_6', '4', $screen->part3_6 == 4, ['id' => 'e-part3_64']) !!}
                                          <label for="e-part3_64">4.รอยโรคอื่น ๆ ระบุ</label>   
                                      </div>                                 
                                      <div class="input-field col s12">                                        
                                          <input class="textpart3_6" name="textpart3_6" id="e-textpart3_6" type="text" value="{!! $screen->textpart3_6 !!}">
                                          <label class="textpart3_6" for="e-textpart3_6">โปรดระบุ</label>
                                      </div> 
                                </p>
                           </div>
                         </div>    
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_5, 3_6 -->

                <div class="row">
                     <div class="input-field col s12">                     
                     <label>22.คลำเนื้อเยื่อรอบปากมีลักษณะคล้ายเอ็นแข็งไม่ยืดหยุ่น อ้าปากได้น้อย:</label>
                    <div class="show-on-small">
                        <br />
                    </div>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              {!! Form::radio('part3_7', '1', $screen->part3_7 == 1, ['id' => 'e-part3_71']) !!}
                              <label for="e-part3_71">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              {!! Form::radio('part3_7', '2', $screen->part3_7 == 2, ['id' => 'e-part3_72']) !!}
                              <label for="e-part3_72">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_7 -->              

            </div><!-- .form-body 3 --> 
            </div>
            
            
            @if( Session::get('status') == '1' || Session::get('status') == '2' )
            <!-- ============== Part 4 =============== -->
            <!-- ============== Part 4 =============== -->
            <!-- ============== Part 4 =============== -->
            <div id="tab4" class="row">
            <h4 class="header part center">ส่วนที่ 4 ผลการตรวจวินิจฉัย </h4>
            <div class="form-body">
                
                <div class="row">
                    <div class="input-field col l6 s12">    
                      <label for="date_part4">23.วันที่(ว-ด-ป)</label>    
                      <input id="e-date_part4" name="date_part4" type="text" class="datepicker picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo date("d-m-Y", strtotime($screen->date_part4)); ?>" />    
                    </div>
                    <div class="input-field col l6 s12">
                      <input name="user_part4" id="e-user_part4" type="text" value="{!! (($screen->user_part4 == '')?Session::get('name'):$screen->user_part4) !!}">
                      <label for="e-user_part4">ผู้ตรวจ</label>
                    </div>
                </div> <!-- date_part4 -->  
                
                <div class="row">
                     <div class="input-field">                     
                     <label>24.ผลการตรวจชิ้นเนื้อ:</label>
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                          <div class="col s12"> 
                              {!! Form::radio('part4_1', '1', $screen->part4_1 == 1, ['id' => 'e-part4_11']) !!}
                              <label for="e-part4_11">1.Normol</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('part4_1', '2', $screen->part4_1 == 2, ['id' => 'e-part4_12']) !!}
                              <label for="e-part4_12">2.Inflammation</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('part4_1', '3', $screen->part4_1 == 3, ['id' => 'e-part4_13']) !!}
                              <label for="e-part4_13">3.Dysplasia</label>
                          </div>
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>ระดับ:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="col s12">
                                          {!! Form::radio('part4_2', '1', $screen->part4_2 == 1, ['id' => 'e-part4_21']) !!}
                                          <label for="e-part4_21">1.Mild</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('part4_2', '2', $screen->part4_2 == 2, ['id' => 'e-part4_22']) !!}
                                          <label for="e-part4_22">2.Moderate</label>   
                                      </div>
                                      <div class="col s12">
                                          {!! Form::radio('part4_2', '3', $screen->part4_2 == 3, ['id' => 'e-part4_23']) !!}
                                          <label for="e-part4_23">3.Severe</label>   
                                      </div>                                     
                                </p>
                           </div>
                         </div> 
                        <div class="col s12"> 
                            {!! Form::radio('part4_1', '4', $screen->part4_1 == 4, ['id' => 'e-part4_14']) !!}
                              <label for="e-part4_14">4.Carcinoma in situ</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('part4_1', '5', $screen->part4_1 == 5, ['id' => 'e-part4_15']) !!}
                              <label for="e-part4_15">5.Oral cancer</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('part4_1', '6', $screen->part4_1 == 6, ['id' => 'e-part4_16']) !!}
                              <label for="e-part4_16">6.Other</label>
                          </div>
                          <div class="input-field col s12">                                        
                              <input name="part4_1text" id="e-part4_1text" type="text" value="{!! $screen->part4_1text !!}">
                              <label for="e-part4_1text">โปรดระบุ</label> 
                          </div> 
                      </p>                         
                    </div>                                       
                </div><!-- type_part4_1, 4_2 -->

                 <div class="row">
                    <div class="input-field col s12">
                      <input name="definitive_diag" id="e-definitive_diag" type="text" value="{!! $screen->definitive_diag !!}">
                      <label for="e-definitive_diag">25.Defintive diagnosis</label>
                    </div>
                </div> <!-- definitive_diag -->  

                <div class="row">
                    <div class="input-field">                     
                     <label>26.Group of lesion:</label>
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                          <div class="col s12"> 
                              {!! Form::radio('part4_3', '1', $screen->part4_3 == 1, ['id' => 'e-part4_31']) !!}
                              <label for="e-part4_31">1.Potentially malignant disorder</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('part4_3', '2', $screen->part4_3 == 2, ['id' => 'e-part4_32']) !!}
                              <label for="e-part4_32">2.Oral cancer</label>
                          </div>
                          <div class="col s12">
                              {!! Form::radio('part4_3', '3', $screen->part4_3 == 3, ['id' => 'e-part4_33']) !!}
                              <label for="e-part4_33">3.Other (Reactive, Autoimmune, Infeetion)</label>
                          </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part4_3 -->

                <div class="row">
                    <div class="input-field">                     
                     <label>27.Treatment:</label>
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                                                 
                          <div class="col s12">
                                 {!! Form::radio('part4_4', '1', $screen->part4_4 == 1, ['id' => 'e-part4_41']) !!}
                                 <label for="e-part4_41">1.Medication</label>
                          </div>
                          <div class="input-field col s12">
                                 <input name="part4_41_text" id="e-part4_41_text" type="text" value="{!! $screen->part4_41_text !!}">
                                 <label for="e-part4_41_text">โปรดระบุ</label>
                          </div>
                          
                          <div class="col s12">
                              {!! Form::radio('part4_4', '2', $screen->part4_4 == 2, ['id' => 'e-part4_42']) !!}
                              <label for="e-part4_42">2.Surgery</label>
                          </div>
                          <div class="input-field col s12">
                                 <input name="part4_42_text" id="e-part4_42_text" type="text" value="{!! $screen->part4_42_text !!}">
                                 <label for="e-part4_42_text">โปรดระบุ</label> 
                          </div>
                        
                          <div class="col s12">
                              {!! Form::radio('part4_4', '3', $screen->part4_4 == 3, ['id' => 'e-part4_43']) !!}
                              <label for="e-part4_43">3.Follow up (month)</label>
                          </div>
                          <div class="input-field col s12">
                                 <input name="part4_43_text" id="e-part4_43_text" type="text" value="{!! $screen->part4_43_text !!}">
                                 <label for="e-part4_43_text">โปรดระบุ</label> 
                          </div>
                        
                           <div class="col s12">
                               {!! Form::radio('part4_4', '4', $screen->part4_4 == 4, ['id' => 'e-part4_44']) !!}
                              <label for="e-part4_44">4.Refer (สถานพยาบาล)</label>
                           </div>
                          <div class="input-field col s12">
                                 <input name="part4_44_text" id="e-part4_44_text" type="text" value="{!! $screen->part4_44_text !!}">
                                 <label for="e-part4_44_text">โปรดระบุ</label>
                          </div>
                        
                      </p>                         
                    </div>                                       
                </div><!-- type_part4_4 -->
            
            </div><!-- .form-body 4 -->  
            </div>
            @endif




            <!-- ============== แนบ File =============== -->
            <!-- ============== แนบ File =============== -->
            <!-- ============== แนบ File =============== -->
            <div id="tab5" class="row">
            <h4 class="header part center">ข้อมูลอื่น ๆ</h4>
            <div class="form-body">
                
                <!-- Image All -->
                <div class="row">
                   <div class="col s12">
                      <h2 class="header">ข้อมูลภาพจากระบบ DT-SCREEN</h2>

                      @if( $screen->pic_1 != '' || $screen->pic_2 != '' || $screen->pic_3 != '' )


                          <div class="row">

                            <div class="col s4">
                              @if( $screen->pic_1 != '' )
                                <?php 
                                  $source_img = imagecreatefromstring(base64_decode($screen->pic_1));
                                  $rotated_img = imagerotate($source_img, 360, 0); 
                                  $file = storage_path().'/images-dtscreen/'. $screen->cid.'_'.$screen->id.'_pic_1'. '.jpg';
                                  $imageSave = imagejpeg($rotated_img, $file, 100);
                                  imagedestroy($source_img);
                                ?>
                                
                                {!! Html::image('storage/images-dtscreen/'.$screen->cid.'_'.$screen->id.'_pic_1'. '.jpg', 'pic1', array('class' => 'materialboxed', 'width' => '260' ))!!}
                              @endif
                            </div>
                            <div class="col s4">
                               @if( $screen->pic_2 != '' )
                                <?php 
                                  $source_img2 = imagecreatefromstring(base64_decode($screen->pic_2));
                                  $rotated_img2 = imagerotate($source_img2, 360, 0); 
                                  $file2 = storage_path().'/images-dtscreen/'. $screen->cid.'_'.$screen->id.'_pic_2'. '.jpg';
                                  $imageSave2 = imagejpeg($rotated_img2, $file2, 100);
                                  imagedestroy($source_img2);
                                ?>
                                
                                {!! Html::image('storage/images-dtscreen/'.$screen->cid.'_'.$screen->id.'_pic_2'. '.jpg', 'pic2', array('class' => 'materialboxed', 'width' => '260' ))!!}
                              @endif
                            </div>
                            <div class="col s4">
                              @if( $screen->pic_3 != '' )
                                <?php 
                                  $source_img3 = imagecreatefromstring(base64_decode($screen->pic_3));
                                  $rotated_img3 = imagerotate($source_img3, 360, 0); 
                                  $file3 = storage_path().'/images-dtscreen/'. $screen->cid.'_'.$screen->id.'_pic_3'. '.jpg';
                                  $imageSave3 = imagejpeg($rotated_img3, $file3, 100);
                                  imagedestroy($source_img3);
                                ?>
                                
                                {!! Html::image('storage/images-dtscreen/'.$screen->cid.'_'.$screen->id.'_pic_3'. '.jpg', 'pic3', array('class' => 'materialboxed', 'width' => '260' ))!!}
                              @endif
                            </div>

                          </div>

                      @else
                          - ไม่มีข้อมูลภาพ
                      @endif

                   </div>
                </div>

                <hr/>
                
                <!-- File All -->
                <div class="row">
                   <div class="col s12">
                      <h2 class="header">ข้อมูลไฟล์เอกสาร</h2>

                        <div class="collection">
                          @if($screen->name_file1 != '')
                            <li class="collection-item">
                              <div>แนบไฟล์ 1: {!! $screen->name_file1 !!} <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file1) !!}/{!! $screen->name_file1 !!}/{!! Crypt::encrypt($screen->id) !!}/{!! Crypt::encrypt(1) !!}" title="ลบไฟล์" class="secondary-content icon-color-red"><i class="mdi-action-delete"></i></a> <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file1) !!}/{!! $screen->name_file1 !!}" title="โหลดไฟล์" class="secondary-content"><i class="mdi-file-file-download"></i></a> </div>
                            </li>
                          @endif
                          @if($screen->name_file2 != '')
                            <li class="collection-item">
                              <div>แนบไฟล์ 2: {!! $screen->name_file2 !!} <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file2) !!}/{!! $screen->name_file2 !!}/{!! Crypt::encrypt($screen->id) !!}/{!! Crypt::encrypt(2) !!}" title="ลบไฟล์" class="secondary-content icon-color-red"><i class="mdi-action-delete"></i></a> <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file2) !!}/{!! $screen->name_file2 !!}" title="โหลดไฟล์" class="secondary-content"><i class="mdi-file-file-download"></i></a></div>
                            </li>
                          @endif
                          @if($screen->name_file3 != '')
                            <li class="collection-item">
                              <div>แนบไฟล์ 3: {!! $screen->name_file3 !!} <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file3) !!}/{!! $screen->name_file3 !!}/{!! Crypt::encrypt($screen->id) !!}/{!! Crypt::encrypt(3) !!}" title="ลบไฟล์" class="secondary-content icon-color-red"><i class="mdi-action-delete"></i></a> <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file3) !!}/{!! $screen->name_file3 !!}" title="โหลดไฟล์" class="secondary-content"><i class="mdi-file-file-download"></i></a></div>
                            </li>
                          @endif
                          @if($screen->name_file4 != '')
                            <li class="collection-item">
                              <div>แนบไฟล์ 4: {!! $screen->name_file4 !!} <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file4) !!}/{!! $screen->name_file4 !!}/{!! Crypt::encrypt($screen->id) !!}/{!! Crypt::encrypt(4) !!}" title="ลบไฟล์" class="secondary-content icon-color-red"><i class="mdi-action-delete"></i></a> <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file4) !!}/{!! $screen->name_file4 !!}" title="โหลดไฟล์" class="secondary-content"><i class="mdi-file-file-download"></i></a></div>
                            </li>
                          @endif
                          @if($screen->name_file5 != '')                           
                            <li class="collection-item">
                              <div>แนบไฟล์ 5: {!! $screen->name_file5 !!} <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file5) !!}/{!! $screen->name_file5 !!}/{!! Crypt::encrypt($screen->id) !!}/{!! Crypt::encrypt(5) !!}" title="ลบไฟล์" class="secondary-content icon-color-red"><i class="mdi-action-delete"></i></a> <a href="{!! url('downloads') !!}/{!! Crypt::encrypt($screen->file5) !!}/{!! $screen->name_file5 !!}" title="โหลดไฟล์" class="secondary-content"><i class="mdi-file-file-download"></i></a></div>
                            </li>
                          @endif
                        </div>
                        
                        <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 1</span>
                              <input name="file1" id="efile1" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                          <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 2</span>
                              <input name="file2" id="efile2" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                        <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 3</span>
                              <input name="file3" id="efile3" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                          <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 4</span>
                              <input name="file4" id="efile4" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                          <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 5</span>
                              <input name="file5" id="efile5" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                              
                   </div>
                </div>
            
            </div><!-- .form-body แนบ File -->  
            </div>



            <div class="row">
            <div class="col s12 center">
                
                  <button class="btn waves-effect waves-light" type="submit" name="action">
                      บันทึก
                    <i class="mdi-content-send right"></i>
                  </button>
        
            </div>
            </div>

            
            {!! Form::close() !!}<!-- form -->

            
            
        </div>       
    </div> 

@endsection


