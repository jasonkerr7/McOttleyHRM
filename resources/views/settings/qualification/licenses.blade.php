@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
          <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Qualification Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/manage-skills"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Skills</a></li>
                <li class="b-b b-light"><a href="/manage-education"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Education</a></li>
                <li class="b-b b-light"><a href="/manage-licenses"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Licenses</a></li>
                <li class="b-b b-light"><a href="/manage-languages"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Languages</a></li>
                <li class="b-b b-light"><a href="/manage-memberships"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Memberships</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                     @include('includes.alert')
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found :  {{ $items->total() }} {{ str_plural('Licence', $items->total()) }}</span>
                    </div>

                  <form action="/patient.find" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search ...">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </div>
                     </form>
                    </div>
                  </div>
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading font-bold">Licence
                                 <a href="#new-license" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>Licence</th>
                            
                            <th width="20"></th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                         <tbody>
                        @foreach( $items as $key => $item )
                          <tr>
                            
                           <td>{{ ++$key }}</td>
                            <td>{{ $item->type }}</td>
     
                             <td><a href="#modal_check_in" class="bootstrap-modal-form-open" onclick="getDetails('{{ $item->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a>
                             </td>
                             <td><a href="#modal_check_in" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->type }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                            
                          </tr>
                         @endforeach 
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$items->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


<div class="modal fade" id="new-license" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add License</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/add-license" class="panel-body wrapper-lg">
                           @include('settings/qualification/new_license')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                        </section>
                      </div>
                    
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->




<script>
  function deleteDetails(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+ name +" from list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-license',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to be removed from list.", "error");   
        } });

    
   }
</script>


