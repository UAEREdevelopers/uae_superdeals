<h4>Guest Details</h4>

<p>Name: {{$data->name}}</p>
<p>Email: {{$data->email}}</p>
<p>Phone: {{$data->phone}}</p>
<p>Date Selected: {{$data->date ?? ''}}</p>
<p>Nationality: {{$data->nationality}}</p>
<p>Adults: {{$data->no_of_adults}}</p>
<p>Children: {{$data->no_of_children}}</p>
<p>Children Age: {{$data->children_age}}</p>
<p>Requests: {{$data->special_requests}}</p>



<h4>Package Details</h4>

<p>ID: {{$data->package->id}}</p>
<p>Title: {{$data->package->title}}</p>
<p>city : {{$data->package->city}}</p>
<p>Country: {{$data->package->country}} </p>

