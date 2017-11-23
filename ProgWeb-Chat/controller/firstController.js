var navigationBar = angular.module('navigationBar', []);

navigationBar.controller('navigationBarController', function navigationBarController($scope) {
	$scope.test = 'ha';
	$scope.nameBlog = "Blog do Alan";
	$scope.description = "Blog do Master do Site"
	$scope.optionOne = "Inicío";
	$scope.optionTwo = "Login";
	$scope.optionThree = "Cadastrar";
});
