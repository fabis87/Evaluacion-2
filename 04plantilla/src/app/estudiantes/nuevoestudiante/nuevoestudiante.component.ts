import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormControl, FormGroup, ReactiveFormsModule, ValidationErrors, Validators } from '@angular/forms';
import { EstudiantesService } from 'src/app/Services/estudiantes.service';
import { IEstudiante } from 'src/app/Interfaces/iestudiante';
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-nuevoestudiante',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevoestudiante.component.html',
  styleUrl: './nuevoestudiante.component.scss'
})
export class NuevoEstudianteComponent implements OnInit {
  frm_Estudiante = new FormGroup({
    nombre: new FormControl('', Validators.required),
    apellido: new FormControl('', Validators.required),
    fecha_nacimiento: new FormControl('', Validators.required),
    grado: new FormControl('', Validators.required)
  });

  estudiante_id = 0;
  titulo = 'Nuevo Estudiante';

  constructor(
    private estudianteServicio: EstudiantesService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.estudiante_id = parseInt(this.ruta.snapshot.paramMap.get('idEstudiante') || '0', 10);
    if (this.estudiante_id > 0) {
      this.estudianteServicio.uno(this.estudiante_id).subscribe((unestudiante) => {
        this.frm_Estudiante.controls['nombre'].setValue(unestudiante.nombre);
        this.frm_Estudiante.controls['apellido'].setValue(unestudiante.apellido);
        this.frm_Estudiante.controls['fecha_nacimiento'].setValue(unestudiante.fecha_nacimiento);
        this.frm_Estudiante.controls['grado'].setValue(unestudiante.grado);

        this.titulo = 'Editar Estudiante';
      });
    }
  }

  grabar() {
    let estudiante: IEstudiante = {
      estudiante_id: this.estudiante_id,
      nombre: this.frm_Estudiante.controls['nombre'].value,
      apellido: this.frm_Estudiante.controls['apellido'].value,
      fecha_nacimiento: this.frm_Estudiante.controls['fecha_nacimiento'].value,
      grado: this.frm_Estudiante.controls['grado'].value
    };

    Swal.fire({
      title: 'Estudiantes',
      text: '¿Desea guardar al Estudiante ' + this.frm_Estudiante.controls['nombre'].value + '?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.estudiante_id > 0) {
          this.estudianteServicio.actualizar(estudiante).subscribe((res: any) => {
            Swal.fire({
              title: 'Estudiantes',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/estudiantes']);
          });
        } else {
          this.estudianteServicio.insertar(estudiante).subscribe((res: any) => {
            Swal.fire({
              title: 'Estudiantes',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/estudiantes']);
          });
        }
      }
    });
  }

  validadorCedulaEcuador(control: AbstractControl): ValidationErrors | null {
    const cedula = control.value;
    if (!cedula) return null;
    if (cedula.length !== 10) return { cedulaInvalida: true };
    const provincia = parseInt(cedula.substring(0, 2), 10);
    if (provincia < 1 || provincia > 24) return { provincia: true };
    const tercerDigito = parseInt(cedula.substring(2, 3), 10);
    if (tercerDigito < 0 || tercerDigito > 5) return { cedulaInvalida: true };
    const digitoVerificador = parseInt(cedula.substring(9, 10), 10);
    const coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
    let suma = 0;
    for (let i = 0; i < coeficientes.length; i++) {
      const valor = parseInt(cedula.substring(i, i + 1), 10) * coeficientes[i];
      suma += valor > 9 ? valor - 9 : valor;
    }
    const resultado = suma % 10 === 0 ? 0 : 10 - (suma % 10);
    if (resultado !== digitoVerificador) return { cedulaInvalida: true };
    return null;
  }
}
