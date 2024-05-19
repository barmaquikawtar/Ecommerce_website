using MySql.Data.MySqlClient;
using System;
using System.Data;
using System.Data.SqlClient;
using System.Windows.Forms;

namespace Biblio
{
    public partial class Home : Form
    {
        public Home()
        {
            InitializeComponent();
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void menuStrip1_ItemClicked(object sender, ToolStripItemClickedEventArgs e)
        {

        }

        private void User_Click(object sender, EventArgs e)
        {

        }

        private void Home_Load(object sender, EventArgs e)
        {
            MySqlConnection conn;

            string myConnectionString = "server=localhost;uid=root;pwd=;database=biblio";

            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();
               // MessageBox.Show(DateTime.Now.ToString("yyyy-MM-dd"));
                MySqlDataAdapter adapter=new MySqlDataAdapter("select u.name,u.cin,u.email," +
                    "u.phone,o.type,o.name from emprints e " +
                    "inner join ouvrage o on e.ouvrage_id =o.id inner join users u on u.id = e.user_id where date_retour = '"+ DateTime.Now.ToString("yyyy-MM-dd") + "'" 
                    ,conn);
                DataTable dt = new DataTable();
                adapter.Fill(dt);
                dataGridView1.DataSource = dt;
                dataGridView1.Columns[0].HeaderText="Nom";
                dataGridView1.Columns[1].HeaderText = "Cin";
                dataGridView1.Columns[2].HeaderText = "Email";
                dataGridView1.Columns[3].HeaderText = "Tele";
                dataGridView1.Columns[4].HeaderText = "Type d'ouvrage";
                dataGridView1.Columns[5].HeaderText = "Nom d'ouvrage";


                ////emprint
                MySqlDataAdapter adapter2 = new MySqlDataAdapter("select u.name,u.cin,u.email," +
                 "u.phone,o.type,o.name from emprints e " +
                 "inner join ouvrage o on e.ouvrage_id =o.id inner join users u on u.id = e.user_id"
                 , conn);
                DataTable dt2 = new DataTable();
                adapter2.Fill(dt2);
                dataGridView2.DataSource = dt2;
                dataGridView2.Columns[0].HeaderText = "Nom";
                dataGridView2.Columns[1].HeaderText = "Cin";
                dataGridView2.Columns[2].HeaderText = "Email";
                dataGridView2.Columns[3].HeaderText = "Tele";
                dataGridView2.Columns[4].HeaderText = "Type d'ouvrage";
                dataGridView2.Columns[5].HeaderText = "Nom d'ouvrage";

                ////disponible ouvrage
                MySqlDataAdapter adapter3 = new MySqlDataAdapter("SELECT name,type,auteur,editeur,numero FROM `ouvrage` WHERE ouvrage.id NOT IN (SELECT emprints.ouvrage_id from emprints WHERE emprints.etat LIKE 'disponible')"
                 , conn);
                DataTable dt3 = new DataTable();
                adapter3.Fill(dt3);
                dataGridView3.DataSource = dt3;
                dataGridView3.Columns[0].HeaderText = "Nom";
                dataGridView3.Columns[1].HeaderText = "Type";
                dataGridView3.Columns[2].HeaderText = "Auteur";
                dataGridView3.Columns[3].HeaderText = "Editeur";
                dataGridView3.Columns[4].HeaderText = "Numero";
                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void dataGridView2_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void dataGridView2_CellContentClick_1(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void usersToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Client client = new Client();
            client.Show();
        }

        private void hoToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }

        private void ouvragesToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Ouvrage ouvrage = new Ouvrage();
            ouvrage.Show();
        }

        private void emprintsToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Emprint emprint = new Emprint();
            emprint.Show();
        }
    }
}
