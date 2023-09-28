from django.http import HttpResponseRedirect
from django.shortcuts import render
from .models import Liburua
from django.urls import reverse


# Create your views here.

def index(request):
    liburuak = Liburua.objects.all
    return render(request, 'index.html', {'liburua': liburuak})


def add(request):
    return render(request, 'add.html')


def addpost(request):
    titulua = request.POST['titulua']
    egilea = request.POST['egilea']
    orrialde_kopurua = request.POST['orrialde_kopurua']
    generoa = request.POST['generoa']
    liburuberria = Liburua(titulua=titulua, egilea=egilea, orrialde_kopurua=orrialde_kopurua, generoa=generoa)
    liburuberria.save()

    return HttpResponseRedirect(reverse('index'))
