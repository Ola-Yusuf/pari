@extends('admin.layouts.default')

@section('content')
<!-- Container fluid -->
<div class="container-fluid px-6 py-4">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <!-- Page header -->
      <div>
        <div class="border-bottom pb-4 mb-4 ">
          <div class="mb-2 mb-lg-0">
            <h3 class="mb-0 fw-bold">Edit Project</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content -->
  <div class="py-6">
    <!-- row -->
    <div class="row">
      <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6">
        <!-- card -->
        <form action="{{route('admin.update.project', Crypt::encrypt($project->id))}}" method="POST"
          enctype="multipart/form-data">
          @csrf
          <div class="card">
            <!-- card body -->
            <div class="card-body">
              <!-- card title -->
              <!-- row -->
              <div class="row">
                <div class="col-12 mb-5">
                  <label class="form-label" for="selectOne">Service Category</label>
                  <select id="category" name="category" class="form-select @error('category') is-invalid @enderror"
                    required onchange="setService()">
                    <option value="">Choose Category</option>
                    <option value="EVENT MANAGEMENT" {{ old('category')=="EVENT MANAGEMENT" || $project->category
                      =="EVENT MANAGEMENT" ? 'selected' : '' }}>EVENT MANAGEMENT</option>
                    <option value="CONSULTING" {{ old('category')=="CONSULTING" || $project->category =="CONSULTING" ?
                      'selected' : '' }}>CONSULTING</option>
                    <option value="RETAIL & EXHIBITS" {{ old('category')=="RETAIL & EXHIBITS" || $project->category
                      =="RETAIL & EXHIBITS" ? 'selected' : '' }}>RETAIL & EXHIBITS</option>
                    <option value="BRAND ACTIVATION" {{ old('category')=="BRAND ACTIVATION" || $project->category
                      =="BRAND ACTIVATION" ? 'selected' : '' }}>BRAND ACTIVATION</option>
                    <option value="MARKETING COMMUNICATION & STRATEGY" {{
                      old('category')=="MARKETING COMMUNICATION & STRATEGY" || $project->category =="MARKETING
                      COMMUNICATION & STRATEGY" ? 'selected' : '' }}>MARKETING COMMUNICATION & STRATEGY</option>
                  </select>
                  @error('category')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-6 mb-5">
                  <label class="form-label" for="textInput">Serial </label>
                  <input type="text" id="serial" name="serial"
                    value="{{ old('serial') ? old('serial') : $project->serial }}"
                    class="form-control @error('serial') is-invalid @enderror" readonly>
                  @error('serial')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-6 mb-5">
                  <label class="form-label" for="textInput">Start Date</label>
                  <input type="date" id="startDate" name="startDate"
                    value="{{ old('startDate') ? old('startDate') : ($project->startDate ? $project->startDate->format('Y-m-d'):'') }}"
                    class="form-control @error('startDate') is-invalid @enderror" placeholder="2001-04-23">
                  @error('startDate')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-12 mb-5">
                  <label class="form-label" for="selectOne">Customer</label>
                  <select id="ownBy" name="ownBy" class="form-select @error('ownBy') is-invalid @enderror">
                    <option value="">Choose an option</option>
                    @foreach ($clients as $key => $item)
                    <option value="{{$item->id}}" {{$item->id == $project->ownBy ? 'selected' : ''}}>{{$item->fname}}
                      ({{$item->username}})</option>
                    @endforeach
                  </select>
                  @error('ownBy')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="col-12 mb-5">
                  <label class="form-label" for="textareaInput">Project/Supporting File
                    <span class="text-secondary"> (.docx, .pdf, .xlxs, .jpg, .png & .jpeg) optional</span></label>
                  <input type="file" id="projectFile" name="projectFile"
                    value="{{ old('percentageComplete') ? old('percentageComplete') : $project->percentageComplete }}"
                    class="form-control @error('projectFile') is-invalid @enderror">
                  @error('projectFile')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-12 mb-5">
                  <label class="form-label" for="textareaInput">Description</label>
                  <textarea align="justify" id="description" name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Describe Goal of the Project ..." rows="3">{{ old('description') ? old('description') : $project->description }}
                </textarea>
                  @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-xl-6 col-lg-12 col-md-12 col-12 mb-6">
        <!-- card -->
        <div class="card">
          <!-- card body -->
          <div class="card-body">
            <!-- card title -->
            <!-- row -->
            <div class="row">

              <div class="col-12 mb-5">
                <label class="form-label" for="selectOne">Product/Service</label>
                <select id="title" name="title" class="form-select @error('title') is-invalid @enderror" required>
                  <option value="">Choose a product/service</option>
                  <option value="{{$project->title}}" selected>{{$project->title}}</option>
                </select>
                @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-6 mb-5">
                <label class="form-label" for="textInput">Status (% Complete)</label>
                <input type="number" id="percentageComplete" name="percentageComplete"
                  value="{{ old('percentageComplete') ? old('percentageComplete') : $project->percentageComplete }}"
                  class="form-control @error('percentageComplete') is-invalid @enderror" placeholder="0 - 100" min="0"
                  max="100">
                @error('percentageComplete')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-6 mb-5">
                <label class="form-label" for="selectOne">Is Product/Service Delivered To Client/Customer?</label>
                <select id="isDelivered" name="isDelivered"
                  class="form-select @error('isDelivered') is-invalid @enderror">
                  <option value="0" {{!$project->isDelivered ? 'selected' : ''}}>No</option>
                  <option value="1" {{$project->isDelivered ? 'selected' : ''}}>Yes</option>
                </select>
                @error('isDelivered')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-12 mb-5">
                <label class="form-label" for="textInput">Completed Date <span
                    class="text-secondary">(optional)</span></label>
                <input type="date" id="completeDate" name="completeDate"
                  value="{{ old('completeDate') ? old('completeDate') : ($project->completeDate ? $project->completeDate->format('Y-m-d') : '') }}"
                  class="form-control @error('completeDate') is-invalid @enderror" placeholder="05/04/2001">
                @error('completeDate')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-12 mb-5">
                <label class="form-label" for="textInput">Delivery Date <span
                    class="text-secondary">(optional)</span></label>
                <input type="date" id="deliveryDate" name="deliveryDate"
                  value="{{ old('deliveryDate') ? old('deliveryDate') : ($project->deliveryDate ? $project->deliveryDate->format('Y-m-d') : '') }}"
                  class="form-control @error('deliveryDate') is-invalid @enderror" placeholder="05/04/2001">
                @error('deliveryDate')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-12 mb-5">
                <label class="form-label" for="textareaInput">Requirements</label>
                <textarea align="justify" id="requirement" name="requirement"
                  class="form-control @error('requirement') is-invalid @enderror"
                  placeholder="List Major Requirement/Features of the project" rows="4">{{ old('requirement') ? old('requirement') : $project->requirement }}
                    </textarea>
                @error('requirement')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12" align="center">
        <button class="btn btn-primary" type="submit">Submit form</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-danger" type="reset">Clear</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection


@section('bottom_script')
<script>
  var event_management = [
                        'Conference & Exhibition',
                        'Corporate Meets',
                        'Product Launch',
                        'Customer / Dealer / Retailers Meets',
                        'Fashion Show',
                        'Theme Parties',
                        'Artist Management',
                        'Star Night',
                        'Awards Functions',
                        ];
    var consulting = [
                      'Project Inception Reports',
                      'DPR',
                      'Project Management Consultancy',
                      'Audit and Appraisal',
                      ];

    var retail_exhibits = [
                      'Exhibition Stall Designing & Fabrication',
                      'Visual Merchandising Programs',
                      'In Shop Activities / Demonstration',
                      'Retail Branding',
                      'Audio Visual, Staging & Lighting Setup',
                      'Corporate Gifting',
                      ];
  var  brand_activation = [
                          'Road Show',
                          'Mall Promotions',
                          'Institution Promotion',
                          'Rural Program',
                          'Sales Driven Campaigning',
                          'Float / Center Activities',
                          'Social Awareness Campaigning',
                          'Ad & Corporate Film Making',
                          'Recreational Tours',
                          ];
  var marketing_communication_strategy = [
                          'Media & Public Relations / Press Conferences',
                          'Copywriting',
                          'Freelance Marketing Consultancy',
                          'Telemarketing',
                          'Website Design',
                          'Brochure / Leaflets Designing & Printing',
                          'Social Media',
                          'Digital Marketing',
                          'Sales Promotions',
                          'Field Marketing',
                          ];
  let setService = () => {
        x = {!! json_encode($project->title) !!};
        // alert(x);
        let d = document.getElementById("category").value;
        let t = document.getElementById("title");
            t.removeAttribute('disabled');
        //remove options 
        let options = t.getElementsByTagName('option');
          for (let i=options.length; i--;) {
              t.removeChild(options[i]);
          }
        
        opt = document.createElement('option');
        opt.value = ''
        opt.innerHTML = 'Choose Product/Service' 
        t.appendChild(opt);
        
        if(d == 'EVENT MANAGEMENT'){
          //create and add new options 
          for (let i = 0; i <= event_management.length - 1 ; i++){
            opt = document.createElement('option');
            opt.value = event_management[i]
            opt.innerHTML = event_management[i]
            t.appendChild(opt);
            if (x == event_management[i])
              t.value = x;
          }
        }

        if(d == 'CONSULTING'){
          //create and add new options 
          for (let i = 0; i <= consulting.length - 1 ; i++){
            opt = document.createElement('option');
            opt.value = consulting[i]
            opt.innerHTML = consulting[i]
            t.appendChild(opt);
            if (x == consulting[i])
              t.value = x;
            
          }
        }

        if(d == 'RETAIL & EXHIBITS'){
          //create and add new options 
          for (let i = 0; i <= retail_exhibits.length - 1 ; i++){
            opt = document.createElement('option');
            opt.value = retail_exhibits[i]
            opt.innerHTML = retail_exhibits[i]
            t.appendChild(opt);
            if (x == retail_exhibits[i])
              t.value = x;
            
          }
        }
        if(d == 'BRAND ACTIVATION'){
          //create and add new options 
          for (let i = 0; i <= brand_activation.length - 1 ; i++){
            opt = document.createElement('option');
            opt.value = brand_activation[i]
            opt.innerHTML = brand_activation[i]
            t.appendChild(opt);
            if (x == brand_activation[i])
              t.value = x;
            
          }
        }
        if(d == 'MARKETING COMMUNICATION & STRATEGY'){
          //create and add new options 
          for (let i = 0; i <= marketing_communication_strategy.length - 1 ; i++){
            opt = document.createElement('option');
            opt.value = marketing_communication_strategy[i]
            opt.innerHTML = marketing_communication_strategy[i]
            t.appendChild(opt);
            if (x == marketing_communication_strategy[i])
              t.value = x;
            
          }
        }
    }
  
  document.addEventListener("DOMContentLoaded", function(){
    setService();
  })
</script>
@endsection