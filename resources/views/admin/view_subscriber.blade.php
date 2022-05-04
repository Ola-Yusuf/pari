@extends('admin.layouts.default')

@section('content')
<div class="container-fluid py-12 px-6 px-xl-0">
  <div class="row">
    <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
      <!-- card  -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <div class="card h-100">
          <!-- card header  -->
          <div class="card-header bg-white border-bottom-0 py-4">
            <h4 class="mb-0"> All Subscribers </h4>
          </div>
          <!-- table  -->
          <div class="table-responsive" style="padding: 10px;">
            @if(count($newsletter) > 0)
            <table class="table text-nowrap dataTable" id="dataTable">
              <thead class="table-light">
                <tr>
                  <th>S/N</th>
                  <th>Email</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($newsletteras $key => $item)
                <tr>
                  <td class="align-middle">{{$key + 1}}</td>
                  <td class="align-middle">{{$item->email}}</td>
                  <td class="align-middle">
                    <div class="dropdown dropstart">
                      <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTeamOne"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-xxs" data-feather="more-vertical"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownTeamOne">
                        <a class="dropdown-item" href="{{route('admin.show.project', Crypt::encrypt($item->id))}}">
                          Send Advert/Newsletter</a>
                        <a class="dropdown-item" style="color: red;"
                          href="{{route('admin.delete.project', Crypt::encrypt($item->id))}}">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <p>Subscribers Not Avalable At The Moment</p>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('bottom_script')
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
    });
</script>
@endsection