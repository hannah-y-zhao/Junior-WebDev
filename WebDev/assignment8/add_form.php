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
    </style>
</head>

<body>
    <h1>Movie Database</h1>
    <nav>
        <a href="index-starter.php" class="tab" data-mycontentpanel="#view">View All</a>
        <a href="add_form.php" class="tab active" data-mycontentpanel="#add">Add Movie</a>
        <a href="search_form.php" class="tab" data-mycontentpanel="#search">Search Movies</a>
    </nav>

    <div id="content">
        <div id="view" class="hidden">
            <h2>View</h2>
        </div>
        <div id="add">
            <h2>Add</h2>
            <?php
                if(isset($_GET['message'])&&$_GET['message']=="error"){
                    print "<p style='background-color:red;width:fit-content;padding:1rem;margin:1rem 0 1rem 0;'>Please fill out all options</p>";
                }else if(isset($_GET['message'])&&$_GET['message']=="success") {
                    print "<p style='background-color:chartreuse;width:fit-content;padding:1rem;margin:1rem 0 1rem 0;'>Movie was successfully added!</p>";
                }
            ?>
            <form method="POST" action="add_search.php">
                    <label for="title">Title: <input type="text" id="title" name="title"></label><br><br>
                    <label for="Year">Year: <input type="text" id="year" name="year"></label>
                    <input name="submit" type="submit" value="Submit">
            </form>
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
</body>

</html>