# Generated by Django 4.2.5 on 2023-09-21 10:48

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('blog', '0002_alter_post_edukia'),
    ]

    operations = [
        migrations.AlterField(
            model_name='post',
            name='edukia',
            field=models.CharField(max_length=2500),
        ),
    ]
