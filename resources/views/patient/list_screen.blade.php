@extends('app')

@section('content')

    <div class="row">
        <ol class="cd-breadcrumb custom-separator">
            <li><a href="{!! url('screen') !!}">หน้าหลัก</a></li> 
            <li><a href="{!! url('patient') !!}">ทะเบียนคนไข้</a></li>        
            <li class="current"><em>รายการคัดกรอง : {{ $patient->fullname }}</em></li>
        </ol>
    </div>

    <div class="row">
        <div class="col s12">
            
            <div id="userTable_wrapper" class="dataTables_wrapper no-footer"> 
            <table id="screenTable" class="responsive-table striped" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CID</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>วันที่คัดกรอง</th>
                        <th>คัดกรองโดย</th>
                        <th>ตรวจวินิจฉัย</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php $i=0; ?>              
                    @foreach($screen as $key => $value)
                     <?php $i++;  ?>
                        <tr data-id="{{ $value->id }}">
                            <td>{{ $i }}</td>   
                            <td>{{ $value->cid }}</td>                        
                            <td>{{ $value->fullname }}</td>
                            <td>{{ date("d", strtotime($value->regdate)).'-'.date("m", strtotime($value->regdate)).'-'.(date("Y", strtotime($value->regdate))+543)  }}</td>
                            <td>{{ $value->create_by }}</td>
                            <td>
                                <?php
                                    if( $value->user_part4 == '' ){
                                        echo '<div class="btn-floating waves-effect waves-light yellow tooltipped" data-position="top" data-delay="50" data-tooltip="ยังไม่ตรวจ"><i class="mdi-alert-warning icon-color-qray"></i></div>';
                                    }else{
                                        echo '<div class="btn-floating waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="ตรวจแล้ว"><i class="mdi-action-done icon-color-qray"></i></div>';
                                    }
                                ?>
                            </td>
                            <td>                           	 
                                <a class="btn-floating waves-effect waves-light green tooltipped" data-position="top" data-delay="50" data-tooltip="แก้ไข" href="{{ route( 'screen.edit', Crypt::encrypt($value->id) ) }}">
                                    <i class="mdi-editor-mode-edit icon-color-qray"></i>
                                </a>
                                <a class="btn-floating waves-effect waves-light red btn-screen-delete tooltipped" data-position="top" data-delay="50" data-tooltip="ลบ" href="{{ route( 'screen.destroy', Crypt::encrypt($value->id) ) }}" data-method="delete" data-confirm="ต้องการลบผู้ใช้ {{ e($value->fullname) }}" data-remote="true" rel="nofollow">
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
