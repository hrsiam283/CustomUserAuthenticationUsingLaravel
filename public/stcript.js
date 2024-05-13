angular
  .module("contactList", [])
  // .filter("favorites", function() {
  //   return function(favorites){
  //     switch (favorites) {
  //       case "":
  //         $scope.nameList[$index].favorite = "favorite";
  //         break;
  //       case "favorite":
  //         $scope.nameList[$index].favorite = "";
  //         break;
  //     }
  //   }
  // })
  .controller("nameAdderController", function ($scope) {
    //set temp initial values for testing
    //$scope.nameBox = "George";
    //$scope.emailBox = "george@example.com";
    //

    var nameList = [
      {
        name: "Scott",
        favorite: "",
        phone: "888-888-8888",
        email: "scott@website.com",
        address: "685 address south",
      },
      {
        name: "Chris",
        favorite: "",
        phone: "888-888-8888",
        email: "chris@website.com",
        address: "685 address south",
      },
      {
        name: "Dave",
        favorite: "",
        phone: "888-888-8888",
        email: "dave@website.com",
        address: "685 address south",
      },
      {
        name: "John",
        favorite: "",
        phone: "888-888-8888",
        email: "john@website.com",
        address: "685 address south",
      },
      {
        name: "Craig",
        favorite: "",
        phone: "888-888-8888",
        email: "craig@website.com",
        address: "685 address south",
      },
      {
        name: "Sarah",
        favorite: "favorite",
        phone: "888-888-8888",
        email: "sarah@website.com",
        address: "685 address south",
      },
      {
        name: "Nick",
        favorite: "",
        phone: "888-888-8888",
        email: "nick@website.com",
        address: "685 address south",
      },
      {
        name: "Laura",
        favorite: "",
        phone: "888-888-8888",
        email: "laura@website.com",
        address: "688 address south",
      },
      {
        name: "Amy",
        favorite: "",
        phone: "888-888-8888",
        email: "amy@website.com",
        address: "685 address south",
      },
    ];
    $scope.nameList = nameList;

    $scope.favName = function ($index) {
      switch ($scope.nameList[$index].favorite) {
        case "":
          $scope.nameList[$index].favorite = "favorite";
          break;
        case "favorite":
          $scope.nameList[$index].favorite = "";
          break;
      }

      console.log($scope.nameList[$index].favorite);
    };

    $scope.editing = false;

    $scope.openEdit = function ($index) {
      if (!$scope.editing) {
        //edit contact is open
        $scope.editing = true;
        $scope.contactName = $scope.nameList[$index].name;
        $scope.nameBox = $scope.nameList[$index].name;
        $scope.emailBox = $scope.nameList[$index].email;
        $scope.phoneBox = $scope.nameList[$index].phone;
        $scope.addressBox = $scope.nameList[$index].address;
        $scope.favBox = $scope.nameList[$index].favorite;
        if ($scope.favBox == "favorite") {
          $scope.favBox = true;
        } else {
          $scope.favBox = false;
        }
      } else {
        $scope.editing = false;
        $scope.emailBox = "";
        $scope.nameBox = "";
        $scope.phoneBox = "";
      }
      $scope.editContact = function () {
        console.log($scope.nameList[$index]);
        $scope.nameList.splice($index, 1);
        $scope.addContact();
        $scope.editing = false;
      };
    };

    $scope.nameSorter = function () {
      var byName = $scope.nameList.slice(0);
      byName.sort(function (a, b) {
        var x = a.name.toLowerCase();
        var y = b.name.toLowerCase();
        return x < y ? -1 : x > y ? 1 : 0;
      });
      $scope.nameList = byName;
    };

    //sort onload
    $scope.nameSorter();

    $scope.addContact = function () {
      //since email isn't required...
      $scope.emailBox = $scope.emailBox || $scope.nameBox + "@website.com";
      $scope.phoneBox = $scope.phoneBox || "123-456-7891";

      if ($scope.favBox) {
        $scope.favBox = "favorite";
      } else {
        $scope.favBox = "";
      }

      $scope.nameList.push({
        name: $scope.nameBox,
        favorite: $scope.favBox,
        phone: $scope.phoneBox,
        email: $scope.emailBox,
      });

      $scope.nameSorter();

      $scope.emailBox = "";
      $scope.nameBox = "";
      $scope.phoneBox = "";
    };
    var scott;
    $scope.removeName = function ($index) {
      var curName = $scope.nameList[$index].name;
      $scope.nameList.splice($index, 1);
      console.log(curName + " removed");
    };

    $scope.deleteAll = function () {
      $scope.nameList = [];
    };

    $scope.favSort = false;

    $scope.favToggle = function () {
      if ($scope.favSort) {
        $scope.favSort = false;
      } else {
        $scope.favSort = true;
      }
      console.log($scope.favSort);
    };

    $scope.filterFavs = function (obj) {
      //console.log(obj.name, obj.favorite);
      if ($scope.favSort) {
        if (obj.favorite === "favorite") {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    };
  });
