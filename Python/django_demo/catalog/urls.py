from django.urls import path

from catalog import views

urlpatterns = [
    path('', views.index, name='index'),
    path('books', views.books, name='books'),
    path('authors', views.books, name='books'),
    path('book/<id>', views.books, name='books'),
    path('author/<id>', views.books, name='books'),

]
