<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }

    </style>

</head>

<body>
    @include('navbar')
    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>My TO DO LIST </h1>

            <br>



            {{ 'Welcome , ' . auth()->user()->name }}




        </div>
        {{ session()->get('Message') }}
       
        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>User Name </th>
                <th>action</th>
            </tr>



            @foreach ($data as $Raw)
                <tr>

                    <td>{{ $Raw->id }}</td>
                    <td>{{ $Raw->title }}</td>
                    <td>{{ Str::substr($Raw->content, 0, 70) . ' .... ' }}</td>
                    <td> <img src="{{ url('/tasks/' . $Raw->image) }}" width="80" height="80"> </td>

                    <td>{{ date('d/m/Y', $Raw->startDate) }}</td>
                    <td>{{ date('d/m/Y', $Raw->endDate) }}</td>

                    <td>{{ $Raw->username }}</td>

                    <td>



                        <a href='' data-toggle="modal" data-target="#modal_single_del{{ $Raw->id }}"
                            class='btn btn-danger m-r-1em'>Remove </a>



                        <!-- <a href="{{ url('/Task/' . $Raw->id . '/edit') }}" class='btn btn-primary m-r-1em'>Edit</a> -->

                    </td>

                </tr>
                <div class="modal" id="modal_single_del{{ $Raw->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">delete confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>


                            @if ($Raw->endDate > strtotime(date('d/m/Y')))
                                <div class="modal-body">

                                    Remove {{ $Raw->title }} !
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ url('Task/' . $Raw->id) }}" method="post">

                                        @method('delete')
                                        @csrf

                                        <div class="not-empty-record">
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">close</button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="modal-body">
                                    You Cannot Remove Date Expire
                                </div>
                                <div class="modal-footer">
                                <div class="not-empty-record">

                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">close</button>
                                </div>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach

        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>
