from django.http import HttpResponseRedirect
from django.shortcuts import render, get_object_or_404
from .models import Liburua, Kokalekua, LiburuKokalekua
from django.urls import reverse


# Create your views here.

def index(request): #Kokalekuetan banatuta
    kokalekuak = Kokalekua.objects.all()
    data = []

    for kokalekua in kokalekuak:
        liburuak_kokalekuan = Liburua.objects.filter(liburukokalekua__kokalekua=kokalekua)

        data.append({
            'kokalekua': kokalekua,
            'liburuak': liburuak_kokalekuan,
        })

    return render(request, 'index.html', {'data': data})

def liburudenak(request):
    liburuaktokiekin = []

    liburuak = Liburua.objects.all()

    for liburua in liburuak:
        kokalekuak = LiburuKokalekua.objects.filter(liburua=liburua).values_list('kokalekua__izena', flat=True)
        kokalekuak_str = ', '.join(kokalekuak)

        liburuaktokiekin.append({
            'liburua': liburua,
            'kokalekuak': kokalekuak_str,
        })

    return render(request, 'liburudenak.html', {'liburuaktokiekin': liburuaktokiekin})

#crud liburua
def formaddliburua(request):
    kokalekuak = Kokalekua.objects.all()
    return render(request, 'formaddliburua.html', {'kokalekuak': kokalekuak})

def addliburua(request):
    titulua = request.POST['titulua']
    egilea = request.POST['egilea']
    orrialde_kopurua = request.POST['orrialde_kopurua']
    generoa = request.POST['generoa']
    liburuberria = Liburua(titulua=titulua, egilea=egilea, orrialde_kopurua=orrialde_kopurua, generoa=generoa)
    liburuberria.save()

    kokalekuak = request.POST.getlist('kokalekua')

    for kokaleku_id in kokalekuak:
        kokalekua = Kokalekua.objects.get(id=kokaleku_id)
        liburukokalekua = LiburuKokalekua(liburua=liburuberria, kokalekua=kokalekua)
        liburukokalekua.save()

    return HttpResponseRedirect(reverse('liburudenak'))

def deleteliburua(request, id):
    liburua = Liburua.objects.get(id = id)
    Liburua.delete(liburua)

    return HttpResponseRedirect(reverse('liburudenak'))

def formupdateliburua(request, id):
    liburua = Liburua.objects.get(id=id)
    kokalekuak = Kokalekua.objects.all()
    liburuaren_kokalekuak = liburua.liburukokalekua_set.all()

    liburuaren_kokalekuen_idak = [kokalekua.kokalekua.id for kokalekua in liburuaren_kokalekuak]

    return render(request, 'formupdateliburua.html', {
        'liburua': liburua,
        'kokalekuak': kokalekuak,
        'liburuaren_kokalekuen_idak': liburuaren_kokalekuen_idak,
    })

def updateliburua(request):
    id = request.POST["id"]
    liburua = Liburua.objects.get(id=id)

    titulua = request.POST["titulua"]
    egilea = request.POST["egilea"]
    orri_kop = request.POST["orrialde_kopurua"]
    generoa = request.POST["generoa"]

    liburua.titulua = titulua
    liburua.egilea = egilea
    liburua.orrialde_kopurua = orri_kop
    liburua.generoa = generoa
    liburua.save()

    liburua.liburukokalekua_set.all().delete() #Erlazio guztiak ezabatu

    kokalekuak = request.POST.getlist("kokalekuak")

    for id in kokalekuak:
        kokalekua = Kokalekua.objects.get(id=id)
        LiburuKokalekua.objects.create(liburua=liburua, kokalekua=kokalekua)

    return HttpResponseRedirect(reverse('liburudenak'))

#kokalekuak crud
def kokalekuak(request): #kokalekuak
    kokalekudenak= Kokalekua.objects.all()
    return render(request, 'kokalekuak.html', {'kokalekuak': kokalekudenak})
def formaddkokalekua(request):
    return render(request, 'formaddkokalekua.html')
def addkokalekua(request):
    izena = request.POST['izena']
    pisua = request.POST['pisua']
    kokaleku_berria = Kokalekua(izena=izena, pisua=pisua)
    kokaleku_berria.save()

    return HttpResponseRedirect(reverse('kokalekuak'))

def deletekokalekua(request, id):
    kokalekua = Kokalekua.objects.get(id = id)
    Kokalekua.delete(kokalekua)

    return HttpResponseRedirect(reverse('kokalekuak'))

def formupdatekokalekua(request, id):
    kokalekua = Kokalekua.objects.get(id = id)
    return render(request, 'formupdatekokalekua.html', {'kokalekua': kokalekua})

def updatekokalekua (request):
    id = request.POST["id"]
    kokalekua = Kokalekua.objects.get(id=id)

    izena = request.POST["izena"]
    pisua = request.POST["pisua"]

    kokalekua.izena = izena
    kokalekua.pisua = pisua
    kokalekua.save()

    return HttpResponseRedirect(reverse('kokalekuak'))