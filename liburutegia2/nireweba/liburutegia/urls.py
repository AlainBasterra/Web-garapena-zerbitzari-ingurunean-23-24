from django.urls import path, include
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('liburudenak', views.liburudenak, name='liburudenak'),
    path('kokalekuak', views.kokalekuak, name='kokalekuak'),

    #liburua crud
    path('formaddliburua/', views.formaddliburua, name='formaddliburua'),
    path('formaddliburua/addliburua/', views.addliburua, name='addliburua'),

    path('deleteliburua/<int:id>/', views.deleteliburua, name='deleteliburua'),

    path('formupdateliburua/<int:id>/', views.formupdateliburua, name='formupdateliburua'),
    path('formupdateliburua/updateliburua/', views.updateliburua, name='updateliburua'),

    #kokalekuakcrud
    path('formaddkokalekua/', views.formaddkokalekua, name='formaddkokalekua'),
    path('formaddkokalekua/addkokalekua/', views.addkokalekua, name='addkokalekua'),

    path('deletekokalekua/<int:id>/', views.deletekokalekua, name='deletekokalekua'),

    path('formupdatekokalekua/<int:id>/', views.formupdatekokalekua, name='formupdatekokalekua'),
    path('formupdatekokalekua/updatekokalekua/', views.updatekokalekua, name='updatekokalekua'),
]
