@extends('app')

@section('content')

    <div class="row">
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li> 
            <li><a href="{!! url('patient') !!}">ทะเบียนคนไข้</a></li>        
            <li class="current"><em>รายการการรักษา : {{ $patient->fullname }}</em></li>
        </ol>
    </div>

    <div class="row">
        <a class="waves-effect waves-light btn" href="{{ url('treatment/create') }}/{{ Crypt::encrypt($patient->id) }}">เพิ่มรายการรักษา</a>
    </div>

    <div class="row">
        <div class="col s12">
            
            <div id="treatmentTable_wrapper" class="dataTables_wrapper no-footer"> 
            <table id="treatmentTable" class="responsive-table striped" >
                <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>Finding</th>
                        <th>Treatment</th>
                        <th>Remark</th>
                        <th>วันนัด</th>
                        <th>เวลานัด</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php $i=0; ?>              
                    @foreach($treatment as $key => $value)
                     <?php $i++;  ?>
                        <tr class="box-text-small" data-id="{{ $value->id }}">
                            <td>{{ date("d", strtotime($value->vstdate)).'-'.date("m", strtotime($value->vstdate)).'-'.(date("Y", strtotime($value->vstdate))+543)  }}</td> 
                            <td>{{ $value->finding }}</td>                        
                            <td>{{ $value->treatment }}</td>
                            <td>{{ $value->remark }}</td>
                            <td>
                                <?php
                                    if( $value->nextdate == '0000-00-00' ){
                                        echo '-';
                                    }else{
                                        echo date("d", strtotime($value->nextdate)).'-'.date("m", strtotime($value->nextdate)).'-'.(date("Y", strtotime($value->nextdate))+543);
                                    }
                                ?>
                            </td> 
                            <td>
                                <?php
                                    if( $value->nexttime == '00:00:00' ){
                                        echo '-';
                                    }else{
                                        echo $value->nexttime;
                                    }
                                ?>
                            </td> 
                            <td>                           	 
                                <a class="btn-floating waves-effect waves-light green tooltipped" data-position="top" data-delay="50" data-tooltip="แก้ไข" href="{{ route( 'treatment.edit', Crypt::encrypt($value->id) ) }}">
                                    <i class="mdi-editor-mode-edit icon-color-qray"></i>
                                </a>
                                <a class="btn-floating waves-effect waves-light red btn-treatment-delete tooltipped" data-position="top" data-delay="50" data-tooltip="ลบ" href="{{ route( 'treatment.destroy', Crypt::encrypt($value->id) ) }}" data-method="delete" data-confirm="ต้องการลบข้อมูล" data-remote="true" rel="nofollow">
                                    <i class="mdi-action-delete icon-color-red"></i>
                                </a>
                            </td>
                        </tr>           
                    @endforeach
                    
                </tbody>
            </table>
            </div>
            
        </div>
    </div>
    

@endsection
