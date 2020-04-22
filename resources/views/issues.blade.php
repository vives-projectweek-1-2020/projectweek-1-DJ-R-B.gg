<!DOCTYPE html> 
<html lang="en">
<head>
<title>Issuelist</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</head>
      <body>
         <div class="container">
            <h2> Pagination</h2>
            <table class="table table-bordered" id="laravel">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Created at</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($data as $data)
                  <tr>
                     <td>{{ $data->id }}</td>
                     <td>{{ $data->name }}</td>
                     <td>{{ date('d m Y', strtotime($data->IssueCreate)) }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
   </body>
</html>

