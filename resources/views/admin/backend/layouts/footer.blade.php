{{-- <footer class="main-footer">
    <strong>Copyright &copy; <a href="http://egskill.com">egskill</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer> --}}

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('/backend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('/backend/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
{{-- <script src="{{ asset('/backend/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('/backend/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{ asset('/backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{ asset('/backend/plugins/moment/moment.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('/backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('/backend/plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('/backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/backend/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('/backend/dist/js/pages/dashboard.js')}}"></script> --}}
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/backend/dist/js/demo.js')}}"></script>

<script src="{{ asset('/backend/js/select-all.js')}}"></script>
<script src="{{ asset('/backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('/backend/dropzone-5.7.0/dist/min/dropzone.min.js')}}"></script>
<script src="{{ asset('/backend/plugins/viewer/viewer.min.js')}}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script> --}}

<!-- dataTable -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
{{-- scrollbar --}}
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
</script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").remove();
        }, 5000); // 5 secs

    });

    $(document).ready(function() {
        $('select').select2({theme: "bootstrap4"});
    });


    // yajradatatables

    $(function() {
        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
        let selectAllButtonTrans = '{{ trans('global.select_all') }}'
        let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

        let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
            className: 'btn'
        })
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            }
            , columnDefs: [{
                orderable: false
                , className: 'select-checkbox'
                , targets: 0
            }, {
                orderable: false
                , searchable: false
                , targets: -1
            }]
            , select: {
                style: 'multi+shift'
                , selector: 'td:first-child'
            }
            , order: []
            , scrollX: true
            , pageLength: 100
            // ,responsive: true
            , dom: 'lBfrtip<"actions">'
            , buttons: [{
                    extend: 'selectAll'
                    , className: 'btn-primary'
                    , text: selectAllButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'selectNone'
                    , className: 'btn-primary'
                    , text: selectNoneButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'copy'
                    , className: 'btn-default'
                    , text: copyButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'csv'
                    , className: 'btn-default'
                    , text: csvButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'excel'
                    , className: 'btn-default'
                    , text: excelButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'pdf'
                    , className: 'btn-default'
                    , text: pdfButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'print'
                    , className: 'btn-default'
                    , text: printButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'colvis'
                    , className: 'btn-default'
                    , text: colvisButtonTrans
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
    });

</script>

{{-- ckeditor for descriptions --}}
<script src="{{ asset('backend/plugins/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('backend/plugins/ckeditor5/build/config.js') }}"></script>
<script src="{{ asset('js/admin/ckfinder/ckfinder.js')}}"></script>

{{-- dattepicker --}}
<script src="{{ asset('backend/datetime-picker/jquery.datetimepicker.full.min.js')}}"></script>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<script>
    $('.image-viewer').each(function(i,ele){
        new Viewer(document.getElementsByClassName('image-viewer')[i]);
    });
        $(function(){

            $('.date-time-picker').datetimepicker({});

        //adding editor
        $('.editor').each(function(i,ele){
            let value = $(this).parents('.editor-container').find('textarea').text();
            let $id = $(this).attr('id');
            let $this = $(this);
            if($(this).attr('id')!=undefined){

            ckConfig["simpleUpload"] = {
        // The URL that the images are uploaded to.
        uploadUrl: '{{route("admin.assignments.storeMedia")}}',

        // Enable the XMLHttpRequest.withCredentials property.
        withCredentials: true,

        // Headers sent along with the XMLHttpRequest to the upload server.
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}',
        }
    };
            InlineEditor.create( document.querySelector( '#'+$(this).attr('id') ), ckConfig
    //         simpleUpload: {
    //     // The URL that the images are uploaded to.
    //     uploadUrl: '{{route("admin.assignments.storeMedia")}}',

    //     // Enable the XMLHttpRequest.withCredentials property.
    //     withCredentials: true,

    //     // Headers sent along with the XMLHttpRequest to the upload server.
    //     headers: {
    //         'X-CSRF-TOKEN': '{{csrf_token()}}',
    //     }
    // })
            ).then(editor=>{
                editor.setData(value);
                editor.model.document.on( 'change', ( evt, data ) => {
                    $this.parents('.editor-container').find('textarea').html(editor.getData());
                });
            });
            }
    });

    //editor in option
    $('.option-editor').each(function(i,ele){
        let value = $(this).parents('.option-container').find('textarea').text();
        let $id = $(this).attr('id');
        let $this = $(this);
            InlineEditor.create( document.querySelector( '#'+$(this).attr('id') ), optionConfig ).then(editor=>{
                editor.setData(value);
                editor.model.document.on( 'change', ( evt, data ) => {
                    $this.parents('.option-container').find('textarea').html(editor.getData());
                });
            });
    });

    //readonly editor for viewing editor text
    $('.readonly-editor').each(function(i,ele){
        let value = $(this).text();
        let $this = $(this);
            InlineEditor.create( document.querySelector( '#'+$(this).attr('id') ), {
                image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side'
        ]
    },
            isReadOnly: true,
            } ).then(editor=>{
                editor.isReadOnly = true;
                editor.setData(value);
            });
    });

    function get_notification() {
                $.ajax({
                type: 'GET'
                , url: "{{ route('admin.get_notifications') }}"
                ,success: function(data) {
                    if(data.length == 0){
                        $('.notification-menu').html(`
                            <span class="dropdown-item dropdown-header">No Notification</span>
                        `);
                    }else{
                        $('.notification-menu').html('');
                        $('.notification-count').text(data.length);
                $.each(data,function(i,ele){
                    $('.notification-menu').append(`
                            <a href="${"{{ route('admin.show_notifications','temp_id') }}".replace('temp_id',ele.id)}" class="dropdown-item notification">
                                <p><i class="fas fa-trophy mr-2"></i>${ele.data.message}</p>
                                <span class="float-right text-muted text-sm">${moment(ele.created_at).fromNow()}</span>
                            </a>
                        <div class="dropdown-divider"></div>
                    `);
                });
                $('.notification-menu').append('<div class="dropdown-divider"></div><a href="{{ route("admin.read_all_notifications") }}" class="dropdown-item read-notification dropdown-footer">Mark as Read</a>');
                    }
                }
            });
    }
    get_notification();
    setInterval(get_notification, 300000);

  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover();
});

</script>
@yield('scripts')
<script>
    $(document).ready(function() {
        $('.loading').addClass('d-none');
    });
</script>
