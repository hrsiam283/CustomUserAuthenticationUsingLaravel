<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div ng-app="contactList" ng-controller="nameAdderController as nameAdder">
        <div class="container">
            <div class="row">
                <header class="col-md-offset-1 col-md-10">
                    <h1>Contact Management</h1>

                    <hr>
                </header>
            </div>

            <div class="row">
                <div class="col-md-offset-1 col-md-3 module contact-builder">

                    <form class="form" ng-submit="addContact()" ng-hide="editing">
                        <h4>Add Contact</h4>
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder="Name (First & Last)"
                                ng-model="nameBox" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Email..."
                                ng-model="emailBox">
                        </div>
                        <div class="form-group">
                            <input type="type" id="phone" class="form-control" placeholder="Phone..."
                                ng-model="phoneBox">
                        </div>
                        <div class="form-group">
                            <input type="type" id="address" class="form-control" placeholder="address..."
                                ng-model="addressBox">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="fav" placeholder="Favorite" ng-model="favBox"> <i
                                class="glyphicon glyphicon-heart"></i>Favorite</input>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>Add
                                Contact</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="Logout" class="btn btn-default2"><i
                                    class="glyphicon glyphicon-new-window"></i>Logout</button>
                        </div>
                    </form>

                    <form ng-submit="editContact()" ng-show="editing" class="animated flipInY">
                        <h4>Edit </h4>
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder="Name (First & Last)"
                                ng-model="nameBox" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Email" ng-model="emailBox">
                        </div>
                        <div class="form-group">
                            <input type="type" id="phone" class="form-control" placeholder="Phone" ng-model="phoneBox">
                        </div>
                        <div class="form-group">
                            <input type="type" id="address" class="form-control" placeholder="address..."
                                ng-model="addressBox">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="fav" placeholder="Favorite" ng-model="favBox"> <i
                                class="glyphicon glyphicon-heart"></i>Favorite</input>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Edit Contact</button>
                            <button ng-click="openEdit()" class="btn btn-default">Cancel</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-7 module contact-list">
                    <form>
                        <div class="form-group">
                            <h4>Search Contact</h4>
                            <input placeholder="Name, Email, Phone..." class="form-control"
                                ng-model="filters.name"></input>
                        </div>
                        <!-- <div class="form-group">
                  <input type="checkbox" ng-model="exactMatch"> Exact Match</input>
                </div> -->
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-danger" ng-click="deleteAll()"><i
                                    class="glyphicon glyphicon-fire"></i> Delete All Contacts</button>
                            <button ng-click="favToggle()" ng-model="favSort" ng-class="on"
                                class="btn btn-default favorite-btn"><i class="glyphicon glyphicon-heart"></i> Show
                                Favorites</button>
                        </div>
                    </form>
                    <div class="table-wrap clearfix">
                        <table class="table table-hover table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th ng-click="nameSorter()">Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="obj in nameList | filter:filters:exactMatch | filter:filterFavs track by $index"
                                    class="animated fadeIn">
                                    <td class="text-capitalize"><i class="glyphicon glyphicon-user"></i>
                                    </td>
                                    <td class="text-lowercase"><i class="glyphicon glyphicon-envelope"></i>
                                    </td>
                                    <td class="text-lowercase"><i class="glyphicon glyphicon-home"></i>
                                    </td>
                                    <td><i class="glyphicon glyphicon-earphone"></i></td>
                                    <td class="text-right">
                                        <a href="#" ng-click="openEdit($index)"><i
                                                class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="#" ng-click="favName($index)"><i
                                                class="glyphicon glyphicon-heart"></i></a>
                                        <a href="#" ng-click="removeName($index)"><i
                                                class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="row">
            </div>
        </div>
    </div>
    <script src="stcript.js"></script>
</body>

</html>