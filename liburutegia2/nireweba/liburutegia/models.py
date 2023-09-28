from django.db import models

# Create your models here.
class Kokalekua(models.Model):
    izena = models.CharField(max_length=250)
    pisua = models.CharField(max_length=2)
    sortua = models.DateTimeField(auto_now_add=True)

    def __unicode__(self):
        return self.izena

class Liburua(models.Model):
    titulua = models.CharField(max_length=250)
    egilea = models.CharField(max_length=50)
    orrialde_kopurua = models.CharField(max_length=6)
    generoa = models.CharField(max_length=100)

    def __unicode__(self):
        return self.titulua