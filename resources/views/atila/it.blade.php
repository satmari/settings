@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">IT dezurstva za 3. smenu</div>
				
				<p style="color:red;"></p>
					
				<table class="table table-dark">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Ime</th>
				      <th scope="col">Od</th>
				      <th scope="col">Do</th>
				      <th scope="col">Tel</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Atila Satmari</td>
				      <td>14.09</td>
				      <td>20.09</td>
				      <td>065 / 3122502</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Marko Leskov</td>
				      <td>21.09</td>
				      <td>27.09</td>
				      <td>065 / 3122515</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Nikola Stipic</td>
				      <td>28.09</td>
				      <td>04.10</td>
				      <td>065 / 3122540</td>
				    </tr>
				    <tr>
				      <th scope="row">1</th>
				      <td>Atila Satmari</td>
				      <td>05.10</td>
				      <td>11.10</td>
				      <td>065 / 3122502</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Marko Leskov</td>
				      <td>12.10</td>
				      <td>18.10</td>
				      <td>065 / 3122515</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Nikola Stipic</td>
				      <td>19.10</td>
				      <td>25.10</td>
				      <td>065 / 3122540</td>
				    </tr>
				    <tr>
				      <th scope="row">1</th>
				      <td>Atila Satmari</td>
				      <td>26.10</td>
				      <td>01.11</td>
				      <td>065 / 3122502</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Marko Leskov</td>
				      <td>02.11</td>
				      <td>08.11</td>
				      <td>065 / 3122515</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Nikola Stipic</td>
				      <td>09.11</td>
				      <td>15.11</td>
				      <td>065 / 3122540</td>
				    </tr>
				    <tr>
				      <th scope="row">1</th>
				      <td>Atila Satmari</td>
				      <td>16.11</td>
				      <td>22.11</td>
				      <td>065 / 3122502</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Marko Leskov</td>
				      <td>23.11</td>
				      <td>29.11</td>
				      <td>065 / 3122515</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Nikola Stipic</td>
				      <td>30.11</td>
				      <td>06.12</td>
				      <td>065 / 3122540</td>
				    </tr>
				    <tr>
				      <th scope="row">1</th>
				      <td>Atila Satmari</td>
				      <td>07.12</td>
				      <td>13.12</td>
				      <td>065 / 3122502</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>Marko Leskov</td>
				      <td>14.12</td>
				      <td>20.12</td>
				      <td>065 / 3122515</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>Nikola Stipic</td>
				      <td>21.12</td>
				      <td>27.12</td>
				      <td>065 / 3122540</td>
				    </tr>
				   
				  </tbody>
				</table>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/')}}" class="btn btn-default center-block">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection