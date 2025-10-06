<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Macro 8</title>
    <style>
        nav a:link {
            padding: 10px;
            border-radius: 0px;
            border: 1px solid black;
            text-decoration: none;
        }

        nav {
            margin-bottom: 20px;;
        }

        .active {
            border: 1px solid black;
            background-color: #DDD;
        }

        .hidden {
            display: none;
        }
        table,th,td{
            border: 1px black solid;
        }
        th,td{
            padding:1rem
        }
    </style>
</head>

<body>
    <h1>Movie Database</h1>
    <nav>
        <a href="index-starter.php" class="tab active" data-mycontentpanel="#view">View All</a>
        <a href="add_form.php" class="tab" data-mycontentpanel="#add">Add Movie</a>
        <a href="search_form.php" class="tab" data-mycontentpanel="#search">Search Movies</a>
    </nav>

    <div id="content">
        <div id="view">
            <h2>View</h2>
            <?php
                if (isset($_GET['deleted'])){
                    print "<p style='background-color:chartreuse;width:fit-content;padding:1rem;margin:1rem 0 1rem 0;'>Deleted successfully</p>";
                }
            ?>
        </div>
        <div id="add" class="hidden">
            <h2>Add</h2>
        </div>
        <div id="search" class="hidden">
            <h2>Search</h2>
        </div>
    </div>
    <script>
        // get a ref to all .tab elements
        let allTabs = document.querySelectorAll('.tab');

        // visit each element
        for (let i = 0; i < allTabs.length; i++) {
            // have each element listen for mouse clicks
            allTabs[i].onclick = function (event) {
                // when clicked, make the current active tab inactive
                document.querySelector('.active').classList.remove('active');

                // make this tab active
                event.currentTarget.classList.add('active');

                // hide all of the other content panels
                let allContent = document.querySelectorAll('#content div');
                for (let j = 0; j < allContent.length; j++) {
                    allContent[j].classList.add('hidden');
                }

                // use our dataset property (#ID) to figure out which tab should be shown by using its ID
                let myContentPanel = document.querySelector(event.currentTarget.dataset.mycontentpanel);
                myContentPanel.classList.remove('hidden');
            }
        }

    </script>
    <table>
        <tr>
            <th>Title</th><th>Year</th><th>Delete</th>
        </tr>
        <?php
            // $db = new SQLite3("/home/hz2788/databases/movies.db");
            $path=getcwd();
            $db=new SQLite3($path."/movies.db");

            // step 3: prepare a query to obtain the data from the database
            // (note that you could use interpolation here if you wanted)
            $sql = "SELECT * FROM movies";

            // step 4: prepare a SQL statement object
            $statement = $db->prepare($sql);

            // step 5: run the query
            $result = $statement->execute();

            // step 6: iterate over the results
            while ($row = $result->fetchArray()) {
                // extract the relevant info from the query into some variables
                $id=$row[0];
                $title = $row[1];
                $year = $row[2];
                $delete="<div name='$id'><a href='add_search.php?delete=$id'>Delete</a></div>";

                print "<tr><td>$title</td><td>$year</td><td>$delete</td></tr>";
            }

            // step 7: if we are done with the database we should close it
            // this allows Apache to use it again quickly, rather than waiting for
            // the database's natural timeout to occur
            $db->close();
            unset($db);

            // done!
        ?>
    </table>

</body>

</html>