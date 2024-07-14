using System.Net;

namespace proyecto.Views;

public partial class registrarCliente : ContentPage
{
	public registrarCliente()
	{
		InitializeComponent();
	}

    private void btnGuardar_Clicked(object sender, EventArgs e)
    {
        try
        {
            WebClient cliente = new WebClient();
            var parametros = new System.Collections.Specialized.NameValueCollection();
            parametros.Add("documento", txtDocumento.Text);
            parametros.Add("nombres", txtNombres.Text);
            parametros.Add("apellidos", txtApellidos.Text);
            parametros.Add("telefono", txtTelefono.Text);
            parametros.Add("correo", txtCorreo.Text);
            parametros.Add("password", txtContraseña.Text);

            parametros.Add("rol", "2");

            cliente.UploadValues("http://192.168.200.7/proyecto/usuarios.php", "POST", parametros);
            Navigation.PushAsync(new inicio());
        }
        catch (Exception ex) 
        {
            DisplayAlert("Alerta", ex.Message, "OK");
        }

    }

    private void btnSalir_Clicked(object sender, EventArgs e)
    {
        Navigation.PushAsync(new principal());
    }
}