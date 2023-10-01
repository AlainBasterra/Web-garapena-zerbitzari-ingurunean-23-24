from django.db import models

class Kokalekua(models.Model):
    izena = models.CharField(max_length=250)
    pisua = models.CharField(max_length=2)
    sortua = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return self.izena

class Liburua(models.Model):
    titulua = models.CharField(max_length=250)
    egilea = models.CharField(max_length=50)
    orrialde_kopurua = models.CharField(max_length=6)
    generoa = models.CharField(max_length=100)

    def __str__(self):
        return self.titulua

class LiburuKokalekua(models.Model):
    liburua = models.ForeignKey(Liburua, on_delete=models.CASCADE)
    kokalekua = models.ForeignKey(Kokalekua, on_delete=models.CASCADE)

    def __str__(self):
        return f"{self.liburua.titulua} - {self.kokalekua.izena}"
