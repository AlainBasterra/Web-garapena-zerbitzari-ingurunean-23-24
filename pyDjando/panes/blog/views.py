from django.http import HttpResponseRedirect
from django.shortcuts import render
from .models import Post
from django.urls import reverse

# Create your views here.

def index (request):
    postak = Post.objects.all
    return render(request, 'index.html', {'posta': postak})

def add (request):
    return render(request, 'add.html')

def addpost (request):
    iz = request.POST['izenburua']
    ed = request.POST['edukia']
    postberria = Post(izenburua=iz, edukia = ed, noizsortua = "")
    postberria.save()

    return HttpResponseRedirect(reverse('index'))

def deletepost(request):
    id_posta = request.GET['id_posta']
    posta = Post.objects.get(pk=id_posta)
    posta.delete()
    return HttpResponseRedirect(reverse('index'))


def updatepost(request):
    id_posta = request.POST['id_posta']
    izenburua = request.POST['izenburua']
    edukia = request.POST['edukia']
    Post.objects.filter(pk=id_posta).update(izenburua=izenburua, edukia=edukia)

    return HttpResponseRedirect(reverse('index'))
