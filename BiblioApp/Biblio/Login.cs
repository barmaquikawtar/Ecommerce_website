using MySql.Data.MySqlClient;
using System;
using System.Windows.Forms;

namespace Biblio
{
    public partial class Login : Form
    {
        public Login()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            MySqlConnection conn;

            string myConnectionString = "server=localhost;uid=root;pwd=;database=biblio";

            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();
                if (String.IsNullOrWhiteSpace(textBox1.Text) || String.IsNullOrWhiteSpace(textBox2.Text))
                {
                    error_messages.Text = "please fill you login and password first";
                }
                else
                {
                    String req = "select count(*) as nb from admins where (email like '" + textBox1.Text + "' or name like '"
                        + textBox1.Text + "') and password like '" + textBox2.Text + "'";
                    MySqlCommand cmd = new MySqlCommand(req, conn);
                    int data = int.Parse(cmd.ExecuteScalar().ToString());
                    if (data > 0)
                    {
                        error_messages.Text = "";
                        this.Hide();
                        Home home = new Home();
                        home.Show();
                    }
                    else
                    {
                        error_messages.Text = "user name or password inccorect";
                    }

                }
                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }

        }
    }
}
