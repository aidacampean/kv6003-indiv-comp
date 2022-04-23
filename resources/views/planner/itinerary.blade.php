@extends('layouts.main')

@section('content')

    <a class="align btn green text-white" href="{{ route('invite', ['id' => $data['id']]) }}">+ INVITE PEOPLE</a>
    <create-itinerary :trip='@json($data)' />
    <p>
» Day 1: Bucharest
Explore Bucharest, the capital of Romania.
In the evening enjoy a concert at the Romanian Athenaeum, home of George Enescu Philharmonic Orchestra, or travel to Valea Calugareasca, one of Romania's top wine regions. After wine tasting and dinner return to Bucharest.

» Day 2: Bucharest - Sinaia - Bran - Brasov (105 miles/ 170 km)
Drive or take the train to Sinaia and visit the Peles Castle, the summer residence of Romania's royal family. Peles Castle (completed in 1883) is a masterpiece of German Renaissance architecture.
The smaller Pelisor Castle features a unique collection of Viennese furniture and Tiffany glassware.
Continue straight to Brasov or from Predeal take a 25 miles detour to the village of Bran to visit the 14th century Bran (Dracula's) Castle then continue to Brasov and spend the evening in Brasov Old Town.
Overnight in Brasov.

» Day 3: Brasov - Sighisoara (75 miles/ 120 km)
Sightseeing in Brasov. Highlights include: the Old Town Hall Square, the beautiful Saint Nicholas Church, Brasov Fortress, Franciscan Monastery. Do not miss the Black Church whose name is attributed to a fire set in 1689 by disgruntled invaders unable to breach the city's walls. Ever since, the church and its red-tiled roof have been ash-stained. For a panoramic view of Brasov and the surrounding Carpathians Mountains take the cable car to Postavarul Peak in Poiana Brasov.

» Day 4: Day-trip Sighișoara - Mediaș - Sibiu - Sighișoara (110 miles/ 175 km)
Sightseeing in Sibiu. Highlights include: Craftsmen's Square, Huet Square and Evangelical Church, Bridge of Lies, Goldsmith Square, Great Square, Orthodox Cathedral, Roman Catholic Church, City Hall Tower. From Sibiu, take an afternoon train/ drive back to Sighisoara or to Brasov.;br /: Overnight in Sighisoara or in Brasov.

» Day 5: Sighișoara - Brașov - Bucharest (175 miles/ 290 km)
or continue to the Painted Monasteries in Bucovina.
</p>
@endsection

