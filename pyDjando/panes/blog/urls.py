from django.urls import path, include
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('add/', views.add, name='add'),
    path('add/addpost/', views.addpost, name='addpost'),
    path('ezabatu/', views.deletepost, name='deletepost')
]