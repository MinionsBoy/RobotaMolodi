<address>

    @foreach($companies as $company)

        <div class="panel panel-orange">
            <div class="panel-heading"><h2>Назва : {{$company->company_name}}</h2></div>
            <ul class="list-group">
                <li class="list-group-item">   Сайт : {{$company->company_email}}</li>
                <li class="list-group-item"> <a href="company/{{$company->id}}">Переглянути</a></li>
            </ul>
        </div>
</address>
@endforeach